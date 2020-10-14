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
 *
 * @package block_panopto
 * @copyright Panopto 2020
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 /**
 * File for class UserManagementStructCreateInternalGroupResponse
 * @package UserManagement
 * @subpackage Structs
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
/**
 * This class stands for UserManagementStructCreateInternalGroupResponse originally named CreateInternalGroupResponse
 * Meta informations extracted from the WSDL
 * - from schema : {@link http://demo.hosted.panopto.com/Panopto/PublicAPI/4.6/UserManagement.svc?xsd=xsd0}
 * @package UserManagement
 * @subpackage Structs
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
class UserManagementStructCreateInternalGroupResponse extends UserManagementWsdlClass
{
    /**
     * The CreateInternalGroupResult
     * Meta informations extracted from the WSDL
     * - minOccurs : 0
     * - nillable : true
     * @var UserManagementStructGroup
     */
    public $CreateInternalGroupResult;
    /**
     * Constructor method for CreateInternalGroupResponse
     * @see parent::__construct()
     * @param UserManagementStructGroup $_createInternalGroupResult
     * @return UserManagementStructCreateInternalGroupResponse
     */
    public function __construct($_createInternalGroupResult = NULL)
    {
        parent::__construct(array('CreateInternalGroupResult'=>$_createInternalGroupResult),false);
    }
    /**
     * Get CreateInternalGroupResult value
     * @return UserManagementStructGroup|null
     */
    public function getCreateInternalGroupResult()
    {
        return $this->CreateInternalGroupResult;
    }
    /**
     * Set CreateInternalGroupResult value
     * @param UserManagementStructGroup $_createInternalGroupResult the CreateInternalGroupResult
     * @return UserManagementStructGroup
     */
    public function setCreateInternalGroupResult($_createInternalGroupResult)
    {
        return ($this->CreateInternalGroupResult = $_createInternalGroupResult);
    }
    /**
     * Method called when an object has been exported with var_export() functions
     * It allows to return an object instantiated with the values
     * @see UserManagementWsdlClass::__set_state()
     * @uses UserManagementWsdlClass::__set_state()
     * @param array $_array the exported values
     * @return UserManagementStructCreateInternalGroupResponse
     */
    public static function __set_state(array $_array,$_className = __CLASS__)
    {
        return parent::__set_state($_array,$_className);
    }
    /**
     * Method returning the class name
     * @return string __CLASS__
     */
    public function __toString()
    {
        return __CLASS__;
    }
}
