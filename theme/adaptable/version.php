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
 * Version details
 *
 * @package   theme_adaptable
 * @copyright 2015-2019 Jeremy Hopkins (Coventry University)
 * @copyright 2015-2019 Fernando Acedo (3-bits.com)
 * @copyright 2017-2019 Manoj Solanki (Coventry University)
 * @copyright 2019-onwards G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

defined('MOODLE_INTERNAL') || die;

// The theme name.
$plugin->component = 'theme_adaptable';

// Adaptable version date (YYYYMMDDrr where rr is the release number).
$plugin->version   = 2020073101;

$plugin->requires  = 2020061500.00; // 3.9 (Build: 20200615).

// Adaptable version using SemVer (https://semver.org).
$plugin->release = '3.0.0';

// Adaptable maturity (do not use ALPHA or BETA versions in production sites).
$plugin->maturity = MATURITY_RC;

// Adaptable dependencies (Only Boost as it's the parent theme).
$plugin->dependencies = array(
    'theme_boost'  => 2020061500
);
