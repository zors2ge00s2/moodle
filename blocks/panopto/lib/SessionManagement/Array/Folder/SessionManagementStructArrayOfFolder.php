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
 * File for class SessionManagementStructArrayOfFolder
 * @package SessionManagement
 * @subpackage Structs
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
/**
 * This class stands for SessionManagementStructArrayOfFolder originally named ArrayOfFolder
 * Meta informations extracted from the WSDL
 * - from schema : {@link http://demo.hosted.panopto.com/Panopto/PublicAPI/4.6/SessionManagement.svc?xsd=xsd3}
 * @package SessionManagement
 * @subpackage Structs
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
class SessionManagementStructArrayOfFolder extends SessionManagementWsdlClass
{
    /**
     * The Folder
     * Meta informations extracted from the WSDL
     * - maxOccurs : unbounded
     * - minOccurs : 0
     * - nillable : true
     * @var SessionManagementStructFolder
     */
    public $Folder;
    /**
     * Constructor method for ArrayOfFolder
     * @see parent::__construct()
     * @param SessionManagementStructFolder $_folder
     * @return SessionManagementStructArrayOfFolder
     */
    public function __construct($_folder = NULL)
    {
        parent::__construct(array('Folder'=>$_folder),false);
    }
    /**
     * Get Folder value
     * @return SessionManagementStructFolder|null
     */
    public function getFolder()
    {
        return $this->Folder;
    }
    /**
     * Set Folder value
     * @param SessionManagementStructFolder $_folder the Folder
     * @return SessionManagementStructFolder
     */
    public function setFolder($_folder)
    {
        return ($this->Folder = $_folder);
    }
    /**
     * Returns the current element
     * @see SessionManagementWsdlClass::current()
     * @return SessionManagementStructFolder
     */
    public function current()
    {
        return parent::current();
    }
    /**
     * Returns the indexed element
     * @see SessionManagementWsdlClass::item()
     * @param int $_index
     * @return SessionManagementStructFolder
     */
    public function item($_index)
    {
        return parent::item($_index);
    }
    /**
     * Returns the first element
     * @see SessionManagementWsdlClass::first()
     * @return SessionManagementStructFolder
     */
    public function first()
    {
        return parent::first();
    }
    /**
     * Returns the last element
     * @see SessionManagementWsdlClass::last()
     * @return SessionManagementStructFolder
     */
    public function last()
    {
        return parent::last();
    }
    /**
     * Returns the element at the offset
     * @see SessionManagementWsdlClass::last()
     * @param int $_offset
     * @return SessionManagementStructFolder
     */
    public function offsetGet($_offset)
    {
        return parent::offsetGet($_offset);
    }
    /**
     * Returns the attribute name
     * @see SessionManagementWsdlClass::getAttributeName()
     * @return string Folder
     */
    public function getAttributeName()
    {
        return 'Folder';
    }
    /**
     * Method called when an object has been exported with var_export() functions
     * It allows to return an object instantiated with the values
     * @see SessionManagementWsdlClass::__set_state()
     * @uses SessionManagementWsdlClass::__set_state()
     * @param array $_array the exported values
     * @return SessionManagementStructArrayOfFolder
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
