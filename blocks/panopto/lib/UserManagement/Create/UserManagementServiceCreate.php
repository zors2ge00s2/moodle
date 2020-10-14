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
 * File for class UserManagementServiceCreate
 * @package UserManagement
 * @subpackage Services
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
/**
 * This class stands for UserManagementServiceCreate originally named Create
 * @package UserManagement
 * @subpackage Services
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
class UserManagementServiceCreate extends UserManagementWsdlClass
{
    /**
     * Method to call the operation originally named CreateUser
     * @uses UserManagementWsdlClass::getSoapClient()
     * @uses UserManagementWsdlClass::setResult()
     * @uses UserManagementWsdlClass::saveLastError()
     * @param UserManagementStructCreateUser $_userManagementStructCreateUser
     * @return UserManagementStructCreateUserResponse
     */
    public function CreateUser(UserManagementStructCreateUser $_userManagementStructCreateUser)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->CreateUser($_userManagementStructCreateUser));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Method to call the operation originally named CreateUsers
     * @uses UserManagementWsdlClass::getSoapClient()
     * @uses UserManagementWsdlClass::setResult()
     * @uses UserManagementWsdlClass::saveLastError()
     * @param UserManagementStructCreateUsers $_userManagementStructCreateUsers
     * @return UserManagementStructCreateUsersResponse
     */
    public function CreateUsers(UserManagementStructCreateUsers $_userManagementStructCreateUsers)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->CreateUsers($_userManagementStructCreateUsers));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Method to call the operation originally named CreateInternalGroup
     * @uses UserManagementWsdlClass::getSoapClient()
     * @uses UserManagementWsdlClass::setResult()
     * @uses UserManagementWsdlClass::saveLastError()
     * @param UserManagementStructCreateInternalGroup $_userManagementStructCreateInternalGroup
     * @return UserManagementStructCreateInternalGroupResponse
     */
    public function CreateInternalGroup(UserManagementStructCreateInternalGroup $_userManagementStructCreateInternalGroup)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->CreateInternalGroup($_userManagementStructCreateInternalGroup));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Method to call the operation originally named CreateExternalGroup
     * @uses UserManagementWsdlClass::getSoapClient()
     * @uses UserManagementWsdlClass::setResult()
     * @uses UserManagementWsdlClass::saveLastError()
     * @param UserManagementStructCreateExternalGroup $_userManagementStructCreateExternalGroup
     * @return UserManagementStructCreateExternalGroupResponse
     */
    public function CreateExternalGroup(UserManagementStructCreateExternalGroup $_userManagementStructCreateExternalGroup)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->CreateExternalGroup($_userManagementStructCreateExternalGroup));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Returns the result
     * @see UserManagementWsdlClass::getResult()
     * @return UserManagementStructCreateExternalGroupResponse|UserManagementStructCreateInternalGroupResponse|UserManagementStructCreateUserResponse|UserManagementStructCreateUsersResponse
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
