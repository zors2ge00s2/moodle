<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * contains main Panopto getters
 *
 * @package block_panopto
 * @copyright  Panopto 2009 - 2018 /With contributions from Spenser Jones (sjones@ambrose.edu), and Tim Lock
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

global $CFG;
if (empty($CFG)) {
    require_once(dirname(__FILE__) . '/../../config.php');
}

require_once($CFG->libdir . '/dmllib.php');
require_once(dirname(__FILE__) . '/block_panopto_lib.php');
require_once(dirname(__FILE__) . '/panopto_session_soap_client.php');

/**
 * Panopto category data object. Contains all information needing to sync a category and it's parents with Panopto.
 *
 * @package block_panopto
 * @copyright  Panopto 2009 - 2015
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class panopto_category_data {

    /**
     * @var string $instancename course id class is being provisioned for
     */
    private $instancename;

    /**
     * @var int $moodlecategoryid The id of the target category in Moodle.
     */
    private $moodlecategoryid;

    /**
     * @var string $servername
     */
    private $servername;

    /**
     * @var int $applicationkey
     */
    private $applicationkey;

    /**
     * @var object $sessionmanager instance of the session soap client
     */
    private $sessionmanager;

    /**
     * @var object $authmanager instance of the auth soap client
     */
    private $authmanager;

    /**
     * @var string $activepanoptoserverversion the version of Panopto on the target server
     */
    private $activepanoptoserverversion;

    /**
     * @var bool $hasvalidpanoptoversion whether or not our panoptoversion is high enough
     */ 
    private $hasvalidpanoptoversion;

    /**
     * @var string $categoriesrequiredpanoptoversion Any block_panopto newer than 2018120700 will require a Panopto server to be at least this version to be able to make any category structure calls
     */
    public static $categoriesrequiredpanoptoversion = '6.0.0';

    /**
     * main constructor
     *
     * @param int $moodlecategoryid course id class is being provisioned for. Can be null for bulk provisioning and manual provisioning.
     */
    public function __construct($moodlecategoryid, $selectedserver, $selectedkey) {
        global $USER;

        // Fetch global settings from DB.
        $this->instancename = get_config('block_panopto', 'instance_name');

        if (isset($USER->username)) {
            $username = $USER->username;
        } else {
            $username = 'guest';
        }
        $this->uname = $username;

        // Get servername and application key specific to Moodle course if ID is specified.
        if (isset($moodlecategoryid) && !empty($moodlecategoryid)) {
            $this->moodlecategoryid = $moodlecategoryid;
            $this->sessiongroupid = self::get_panopto_category_id($moodlecategoryid, $selectedserver);
        }

        $this->servername = $selectedserver;
        $this->applicationkey = $selectedkey;

        $this->ensure_auth_manager();
        $this->activepanoptoserverversion = $this->authmanager->get_server_version();

        if ($this->activepanoptoserverversion != false) {
            $this->hasvalidpanoptoversion = version_compare(
                $this->activepanoptoserverversion, 
                \panopto_category_data::$categoriesrequiredpanoptoversion, 
                '>='
            );
        } else {
            $this->activepanoptoserverversion = "N/A";
            $this->hasvalidpanoptoversion = false;
        }
    }

    /**
     * Return the session manager, if it does not yet exist try to create it.
     */
    public function ensure_session_manager() {
        // If no session soap client exists instantiate one.
        if (!isset($this->sessionmanager)) {
            $this->sessionmanager = panopto_instantiate_session_soap_client(
                $this->uname,
                $this->servername,
                $this->applicationkey
            );

            if (!isset($this->sessionmanager)) {
                self::print_log(get_string('api_manager_unavailable', 'block_panopto', 'session'));
            }
        }
    }

    /**
     * Return the auth manager, if it does not yet exist try to create it.
     */
    public function ensure_auth_manager() {
        // If no session soap client exists instantiate one.
        if (!isset($this->authmanager)) {
            // If no auth soap client for this instance, instantiate one.
            $this->authmanager = panopto_instantiate_auth_soap_client(
                $this->uname,
                $this->servername,
                $this->applicationkey
            );

            if (!isset($this->authmanager)) {
                self::print_log(get_string('api_manager_unavailable', 'block_panopto', 'auth'));
            }
        }
    }

    /**
     * We need to retrieve the current category mapping in the constructor, so this must be static.
     *
     * @param int $moodlecategoryid id of the current Moodle course
     */
    public static function get_panopto_category_id($moodlecategoryid, $targetserver) {
        global $DB;
        return $DB->get_field(
            'block_panopto_categorymap', 
            'panopto_id', 
            array('category_id' => $moodlecategoryid, 'panopto_id' => $targetserver)
        );
    }

    /**
     *  Retrieve the servername for the current course
     *
     * @param int $moodlecategoryid id of the current Moodle course
     */
    public static function get_panopto_servername($moodlecategoryid) {
        global $DB;
        return $DB->get_field('block_panopto_categorymap', 'panopto_server', array('category_id' => $moodlecategoryid));
    }

    /**
     *  Builds a list of folders from the target category to the root level in Moodle, sends the data to Panopto to build those folders and set 
     *    folder parents to match the requested structure.
     *
     */
    public function ensure_category_branch($usehtmloutput, $leafcoursedata) {
        global $DB;

        if (!$this->hasvalidpanoptoversion) {

            $panoptoversioninfo = [
                'activepanoptoversion' => $this->activepanoptoserverversion,
                'requiredpanoptoversion' => \panopto_category_data::$categoriesrequiredpanoptoversion
            ];

            if ($usehtmloutput) {
                include('views/ensure_category_branch_failed.html.php');
            } else {
                \panopto_data::print_log(get_string('categories_need_newer_panopto', 'block_panopto', $panoptoversioninfo));
            }
        } 
        else {
            try {

                $targetcategory = $DB->get_record('course_categories', array('id' => $this->moodlecategoryid));

                // Some users have categories with no name, so default it to id. 
                $targetcategoryname = !empty(trim($targetcategory->name)) ? $targetcategory->name : $targetcategory->id;

                $branchinfo = [
                    'targetserver' => $this->servername,
                    'categoryname' => $targetcategoryname
                ];

                if ($usehtmloutput) {
                    include('views/ensure_category_branch_start.html.php');
                } else {
                    \panopto_data::print_log_verbose(get_string('ensure_category_branch_start', 'block_panopto', $branchinfo));
                }
                
                $categoryheirarchy = array();

                if (isset($leafcoursedata) && !empty($leafcoursedata)) {
                    // We don't need to pass a name into this constructor since we can assume course folders exist.
                    $categoryheirarchy[] = new SessionManagementStructExternalHierarchyInfo(
                        null, 
                        $leafcoursedata->moodlecourseid,
                        true
                    );
                }

                $categoryheirarchy[] = new SessionManagementStructExternalHierarchyInfo(
                    $targetcategoryname, 
                    $targetcategory->id,
                    false
                );
                
                $currentcategory = $DB->get_record('course_categories', array('id' => $targetcategory->parent));

                while(isset($currentcategory) && !empty($currentcategory)) {
                    $currentcategoryname = !empty(trim($currentcategory->name)) ? $currentcategory->name : $currentcategory->id;

                    $categoryheirarchy[] = new SessionManagementStructExternalHierarchyInfo(
                        $currentcategoryname, 
                        $currentcategory->id,
                        false
                    );

                    $currentcategory = $DB->get_record('course_categories', array('id' => $currentcategory->parent));
                }

                $this->ensure_session_manager();

                // reverse $categoryheirarchy so the root node of the Moodle category tree is the first element, and the target category is the last element.
                $ensureresults = $this->sessionmanager->ensure_category_branch(array_reverse($categoryheirarchy));

                if (isset($ensureresults) && isset($ensureresults->Results) && !empty($ensureresults->Results)) {
                    $categorydata = $ensureresults->Results->FolderWithExternalContext;
                } else {
                    $categorydata = null;
                }

                if ($categorydata !== null && $categorydata !== false) {
                  $this->save_category_data_to_table($categorydata, $usehtmloutput, $leafcoursedata);
                } else if (!$usehtmloutput) {
                    \panopto_data::print_log(get_string('ensure_category_branch_failed', 'block_panopto'));
                } else {
                    include('views/ensure_category_branch_failed.html.php');
                }

                return $categorydata;
            } catch (Exception $e) {
                \panopto_data::print_log(print_r($e->getMessage(), true));
            }
        }
    }

    private function save_category_data_to_table($categorybranchdata, $usehtmloutput, $leafcoursedata) {
        global $DB;
        $row = (object) array(
            'category_id' => null,
            'panopto_id' => null,
            'panopto_server' => $this->servername,
            'panopto_app_key' => $this->applicationkey
        );

        $ensuredbranch = '';
        $leafcoursesessiongroupid = (isset($leafcoursedata) && !empty($leafcoursedata)) ? $leafcoursedata->sessiongroupid : null;
        foreach($categorybranchdata as $updatedcategory) {

            // Format the output string for the next child in the branch.
            // This is the string to be displayed in the log or UI, use name instead of Id so it's more readeable
            if (!empty($ensuredbranch)) {
                $ensuredbranch .= ' -> ';
            }

            $ensuredbranch .= $updatedcategory->Name;

            // If the returned folder was the leaf course folder no need to save it.
            if (strcmp($leafcoursesessiongroupid, $updatedcategory->Id) !== 0) {
                // $updatedcategory->ExternalIds->string[0] is the format the PHP wsdl mapper returns our call data
                //  We also need to strip <instance_name>// off the externalId to get the true category Id
                $row->category_id = str_replace($this->instancename . '\\', '', $updatedcategory->ExternalIds->string[0]);
                $row->panopto_id = $updatedcategory->Id;

                panopto_category_data::update_category_row($row);
            }
        }

        if ($usehtmloutput) {
            include('views/ensure_category_branch_success.html.php');
        } else {
            \panopto_data::print_log_verbose(get_string('ensure_category_branch_success', 'block_panopto', $ensuredbranch));
        }
    }

    public static function build_category_structure($usehtmloutput, $selectedserver, $selectedkey) {
        global $DB;

        \panopto_data::print_log(get_string('build_category_structure_start', 'block_panopto', $selectedserver));

        $categorybuilder = new \panopto_category_data(null, $selectedserver, $selectedkey);
        $categorybuilder->ensure_auth_manager();


        if (!$categorybuilder->hasvalidpanoptoversion) {
                $panoptoversioninfo = [
                    'activepanoptoversion' => $categorybuilder->activepanoptoserverversion,
                    'requiredpanoptoversion' => \panopto_category_data::$categoriesrequiredpanoptoversion];

            if ($usehtmloutput) {
                include('views/ensure_category_branch_failed.html.php');
            } else {
                \panopto_data::print_log(get_string('categories_need_newer_panopto', 'block_panopto', $panoptoversioninfo));
            }
        } 
        else {
            // Get all categories with no children (all leaf nodes)
            $leafcategories = $DB->get_records_sql(
                'SELECT id FROM {course_categories} WHERE id NOT IN (SELECT parent FROM {course_categories})'
            );

            foreach($leafcategories as $leafcategory) {
                $categorybuilder->moodlecategoryid = $leafcategory->id;
                $categorybuilder->sessiongroupid = self::get_panopto_category_id($leafcategory->id, $selectedserver);
                $categorybuilder->ensure_category_branch($usehtmloutput, null);
            }
        }
    }

    private static function update_category_row($row) {
        global $DB;

        $oldrow = $DB->get_record(
            'block_panopto_categorymap', 
            array(
                'category_id' => $row->category_id, 
                'panopto_server' => $row->panopto_server
            )
        );
        
        if ($oldrow) {
            $row->id = $oldrow->id;
            return $DB->update_record('block_panopto_categorymap', $row);
        } else {
            return $DB->insert_record('block_panopto_categorymap', $row);
        }
    }
}