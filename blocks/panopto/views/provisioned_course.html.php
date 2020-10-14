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
 * the provisioned course template
 *
 * @package block_panopto
 * @copyright  Panopto 2009 - 2015
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>

<div class='block_panopto'>
    <div class='panoptoProcessInformation'>
        <div class='value'>
            <?php
            if (!empty($provisioneddata)) {
                if (!empty($provisioneddata->errormessage)) {
                ?>
                    <div class='errorMessage'>
                        <?php echo $provisioneddata->errormessage ?>
                    </div>
                    <br />
                    <div class='attribute'><?php echo get_string('attempted_moodle_course_id', 'block_panopto') ?></div>
                    <div class='value'><?php echo $provisioneddata->moodlecourseid ?></div>
                    <div class='attribute'><?php echo get_string('attempted_panopto_server', 'block_panopto') ?></div>
                    <div class='value'><?php echo $provisioneddata->servername ?></div>
                <?php
                } 
                else if (isset($provisioneddata->accesserror) && $provisioneddata->accesserror === true) {
                ?>
                    <div class='errorMessage'>
                        <?php echo get_string('provision_access_error', 'block_panopto') ?>
                    </div>
                    <br />
                    <div class='attribute'><?php echo get_string('attempted_moodle_course_id', 'block_panopto') ?></div>
                    <div class='value'><?php echo $provisioneddata->moodlecourseid ?></div>
                    <div class='attribute'><?php echo get_string('attempted_panopto_server', 'block_panopto') ?></div>
                    <div class='value'><?php echo $provisioneddata->servername ?></div>
                <?php
                } 
                else if (isset($provisioneddata->unknownerror) && $provisioneddata->unknownerror === true) {
                ?>
                    <div class='errorMessage'>
                        <?php echo get_string('provision_error', 'block_panopto') ?>
                    </div>
                    <br />
                    <div class='attribute'><?php echo get_string('attempted_moodle_course_id', 'block_panopto') ?></div>
                    <div class='value'><?php echo $provisioneddata->moodlecourseid ?></div>
                    <div class='attribute'><?php echo get_string('attempted_panopto_server', 'block_panopto') ?></div>
                    <div class='value'><?php echo $provisioneddata->servername ?></div>
                <?php
                }
                else {
                ?>
                    <div class='attribute'><?php echo get_string('course_name', 'block_panopto') ?></div>
                    <div class='value'><?php echo $provisioningdata->fullname ?></div>

                    <div class='attribute'><?php echo get_string('synced_user_info', 'block_panopto') ?></div>
                    <?php if (!get_config('block_panopto', 'sync_after_provisioning')) { ?>
                        <div class='value'><?php echo get_string('no_users_synced_desc', 'block_panopto') ?></div>
                    <?php } else if(get_config('block_panopto', 'async_tasks')) { ?>
                        <div class='value'><?php echo get_string('async_wait_warning', 'block_panopto'); ?></div>
                    <?php } else { ?>
                        <div class='value'><?php echo get_string('users_have_been_synced', 'block_panopto'); ?></div>
                    <?php } ?>
                    <div class='attribute'><?php echo get_string('publishers', 'block_panopto') ?></div>
                    <div class='value'>
                        <?php
                            if (!empty($provisioneddata->publishers)) {
                                echo join(', ', $provisioneddata->publishers);
                            } else {
                                ?><div class='errorMessage'><?php echo get_string('no_publishers', 'block_panopto') ?></div><?php
                            }
                        ?>
                    </div>
                    <div class='attribute'><?php echo get_string('creators', 'block_panopto') ?></div>
                    <div class='value'>
                        <?php
                            if (!empty($provisioneddata->creators)) {
                                echo join(', ', $provisioneddata->creators);
                            } else {
                                ?><div class='errorMessage'><?php echo get_string('no_creators', 'block_panopto') ?></div><?php
                            }
                        ?>
                    </div>
                    <div class='attribute'><?php echo get_string('viewers', 'block_panopto') ?></div>
                    <div class='value'>
                        <?php
                            if (!empty($provisioneddata->viewers)) {
                                echo join(', ', $provisioneddata->viewers);
                            } else {
                                ?><div class='errorMessage'><?php echo get_string('no_viewers', 'block_panopto') ?></div><?php
                            }
                        ?>
                    </div>
                    <div class='attribute'><?php echo get_string('result', 'block_panopto') ?></div>
                    <div class="value">
                        <div class='successMessage'>
                            <?php echo get_string('provision_successful', 'block_panopto', $provisioneddata->Id) ?>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class='errorMessage'><?php echo get_string('provision_error', 'block_panopto') ?></div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
