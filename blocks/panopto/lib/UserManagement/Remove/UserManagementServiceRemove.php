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
 * File for class UserManagementServiceRemove
 * @package UserManagement
 * @subpackage Services
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
/**
 * This class stands for UserManagementServiceRemove originally named Remove
 * @package UserManagement
 * @subpackage Services
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
class UserManagementServiceRemove extends UserManagementWsdlClass
{
    /**
     * Method to call the operation originally named RemoveMembersFromInternalGroup
     * @uses UserManagementWsdlClass::getSoapClient()
     * @uses UserManagementWsdlClass::setResult()
     * @uses UserManagementWsdlClass::saveLastError()
     * @param UserManagementStructRemoveMembersFromInternalGroup $_userManagementStructRemoveMembersFromInternalGroup
     * @return UserManagementStructRemoveMembersFromInternalGroupResponse
     */
    public function RemoveMembersFromInternalGroup(UserManagementStructRemoveMembersFromInternalGroup $_userManagementStructRemoveMembersFromInternalGroup)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->RemoveMembersFromInternalGroup($_userManagementStructRemoveMembersFromInternalGroup));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Method to call the operation originally named RemoveMembersFromExternalGroup
     * @uses UserManagementWsdlClass::getSoapClient()
     * @uses UserManagementWsdlClass::setResult()
     * @uses UserManagementWsdlClass::saveLastError()
     * @param UserManagementStructRemoveMembersFromExternalGroup $_userManagementStructRemoveMembersFromExternalGroup
     * @return UserManagementStructRemoveMembersFromExternalGroupResponse
     */
    public function RemoveMembersFromExternalGroup(UserManagementStructRemoveMembersFromExternalGroup $_userManagementStructRemoveMembersFromExternalGroup)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->RemoveMembersFromExternalGroup($_userManagementStructRemoveMembersFromExternalGroup));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Returns the result
     * @see UserManagementWsdlClass::getResult()
     * @return UserManagementStructRemoveMembersFromExternalGroupResponse|UserManagementStructRemoveMembersFromInternalGroupResponse
     */
    public function getResult()
    {
        return parent::getResult();
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
