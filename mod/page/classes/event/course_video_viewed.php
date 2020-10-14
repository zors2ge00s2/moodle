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
 * The mod_page instance list viewed event.
 *
 * @package    mod_page
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_page\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_page instance list viewed event class.
 *
 * @package    mod_page
 * @since      Moodle 2.7
 * @copyright  2013 onwards Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_video_viewed extends \core\event\base{

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'page';
    }
 /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        // Make sure this class is never used without proper object details.
        if (empty($this->objectid) || empty($this->objecttable)) {
            throw new \coding_exception('The course_module_viewed event must define objectid and object table.');
        }
        // Make sure the context level is set to module.
        if ($this->contextlevel != CONTEXT_MODULE) {
            throw new \coding_exception('Context level must be CONTEXT_MODULE.');
        }
    }


    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return "Video Viewed";
    }

     /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, $this->objecttable, 'view', 'view.php?id=' . $this->contextinstanceid, $this->objectid,
                     $this->contextinstanceid);
    }

    public static function get_objectid_mapping() {
        return array('db' => 'page', 'restore' => 'page');
    }
    public function get_description() {
        // global $start, $start_min, $start_sec, $end, $end_min, $end_sec;
        $json = json_decode(json_encode($this->other));
        $start = $json->thisstart;
        $end = $json->thisend;
        $start_min = floor($start/60);
        $start_sec = floor($start%60);
        if($start_sec < 10){
            $start_sec = 0 . "" . $start_sec;
        }
        $start = $start_min . ":" . $start_sec;
        $end_min = floor($end/60);
        $end_sec = floor($end%60);
        if($end_sec < 10){
            $end_sec = 0 . "" . $end_sec;
        }
        $end = $end_min . ":" . $end_sec;
        return "The user with id '$this->userid' has viewed the video at page id '$this->contextinstanceid' with video title '$json->videoid' and watched from '$start'  to '$end' in the video";
    }
}