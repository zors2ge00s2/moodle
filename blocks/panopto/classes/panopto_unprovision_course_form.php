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
 * Create form for server selection.
 *
 * @package block_panopto
 * @copyright  Panopto 2009 - 2015
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class panopto_unprovision_course_form extends moodleform {

    /**
     * Defines a Panopto unprovision form
     */
    public function definition() {

        global $DB, $aserverarray;

        $mform = & $this->_form;

        $this->add_action_buttons(true, get_string('unprovision', 'block_panopto'));
    }
}
