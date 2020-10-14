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
 * the template used to display when we begin processing 
 *
 * @package block_panopto
 * @copyright  Panopto 2009 - 2017
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>

<div class='block_panopto'>
    <div class='panoptoProcessInformation'>
        <div class='value'>
            <?php
            if (isset($branchinfo) && !empty($branchinfo)) {
            ?>
                <div class='attribute'><?php echo get_string('attribute_target_panopto_server', 'block_panopto') ?></div>
                <div class='value'><?php echo $branchinfo['targetserver'] ?></div>
                <div class='attribute'><?php echo get_string('attribute_target_branch_leaf', 'block_panopto') ?></div>
                <div class='value'><?php echo $branchinfo['categoryname'] ?></div>
            <?php
            } else {
            ?>
                <div class='errorMessage'><?php echo get_string('error_invalid_category_information', 'block_panopto') ?></div>
            <?php
            }
            ?>
