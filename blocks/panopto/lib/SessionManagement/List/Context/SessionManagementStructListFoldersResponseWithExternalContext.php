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
 * File for class SessionManagementStructListFoldersResponseWithExternalContext
 * @package SessionManagement
 * @subpackage Structs
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
/**
 * This class stands for SessionManagementStructListFoldersResponseWithExternalContext originally named ListFoldersResponseWithExternalContext
 * Meta informations extracted from the WSDL
 * - from schema : {@link http://demo.hosted.panopto.com/Panopto/PublicAPI/4.6/SessionManagement.svc?xsd=xsd3}
 * @package SessionManagement
 * @subpackage Structs
 * @author Panopto
 * @version 20150429-01
 * @date 2017-01-19
 */
class SessionManagementStructListFoldersResponseWithExternalContext extends SessionManagementWsdlClass
{
    /**
     * The Results
     * Meta informations extracted from the WSDL
     * - minOccurs : 0
     * - nillable : true
     * @var SessionManagementStructArrayOfFolderWithExternalContext
     */
    public $Results;
    /**
     * The TotalNumberResults
     * Meta informations extracted from the WSDL
     * - minOccurs : 0
     * @var int
     */
    public $TotalNumberResults;
    /**
     * Constructor method for ListFoldersResponseWithExternalContext
     * @see parent::__construct()
     * @param SessionManagementStructArrayOfFolderWithExternalContext $_results
     * @param int $_totalNumberResults
     * @return SessionManagementStructListFoldersResponseWithExternalContext
     */
    public function __construct($_results = NULL,$_totalNumberResults = NULL)
    {
        parent::__construct(array('Results'=>($_results instanceof SessionManagementStructArrayOfFolderWithExternalContext)?$_results:new SessionManagementStructArrayOfFolderWithExternalContext($_results),'TotalNumberResults'=>$_totalNumberResults),false);
    }
    /**
     * Get Results value
     * @return SessionManagementStructArrayOfFolderWithExternalContext|null
     */
    public function getResults()
    {
        return $this->Results;
    }
    /**
     * Set Results value
     * @param SessionManagementStructArrayOfFolderWithExternalContext $_results the Results
     * @return SessionManagementStructArrayOfFolderWithExternalContext
     */
    public function setResults($_results)
    {
        return ($this->Results = $_results);
    }
    /**
     * Get TotalNumberResults value
     * @return int|null
     */
    public function getTotalNumberResults()
    {
        return $this->TotalNumberResults;
    }
    /**
     * Set TotalNumberResults value
     * @param int $_totalNumberResults the TotalNumberResults
     * @return int
     */
    public function setTotalNumberResults($_totalNumberResults)
    {
        return ($this->TotalNumberResults = $_totalNumberResults);
    }
    /**
     * Method called when an object has been exported with var_export() functions
     * It allows to return an object instantiated with the values
     * @see SessionManagementWsdlClass::__set_state()
     * @uses SessionManagementWsdlClass::__set_state()
     * @param array $_array the exported values
     * @return SessionManagementStructListFoldersResponseWithExternalContext
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
