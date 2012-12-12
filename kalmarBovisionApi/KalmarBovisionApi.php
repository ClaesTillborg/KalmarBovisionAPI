<?php
namespace kalmarBovisionApi;

require_once(dirname(__FILE__) . "/interface/iKalmarBovisionApi.php");
require_once(dirname(__FILE__) . "/model/KalmarBovisionApiDAL.php");
require_once(dirname(__FILE__) . "/model/ResidentType.php");
require_once(dirname(__FILE__) . "/model/ResidentTypeArray.php");
require_once(dirname(__FILE__) . "/model/Template.php");
require_once(dirname(__FILE__) . "/model/Coverage.php");

class KalmarBovisionApi implements apiInterface\iKalmarBovisionApi {

    // Private fields
    private $_DAL;
    private $_template;

    public function __construct() {

        // Create Template- and DAL-layer
        $this->_DAL = new \kalmarBovisionApi\model\KalmarBovisionApiDAL();
        $this->_template = new model\Template();
    }

    /**
     * @return array of Resident-objects
     */
    public function getRegisteredResidents() {
        return $this->_DAL->getRegisteredResidents();
    }

    /**
     * @return array of Resident-objects
     */
    public function getChangedResidents() {
        return $this->_DAL->getChangedResidents();
    }

    /**
     * @param model\ResidentTypeArray $residentTypeArray
     * @return array of Resident-objects
     */
    public function getRegisteredResidentsByType(model\ResidentTypeArray $residentTypeArray) {
        return $this->_DAL->getRegisteredResidentsByType($residentTypeArray);
    }

    /**
     * @param model\ResidentTypeArray $residentTypeArray
     * @return array of Resident-objects
     */
    public function getChangedResidentsByType(model\ResidentTypeArray $residentTypeArray) {
        return $this->_DAL->getChangedResidentsByType($residentTypeArray);
    }

    /**
     * @param model\Coverage $coverage
     * @return void
     */
    public function setCoverage($coverage) {
        $this->_DAL->setCoverage($coverage);
    }

    /**
     * @return model\ResidentTypeArray
     */
    public function getResidentTypeArray() {
        return new model\ResidentTypeArray();
    }

    /**
     * Returns a HTML5-page with the API's documentation
     *
     * @return string API-documentation
     */
    public function apiDocs () {

        // fetch API-docs
        $docs = $this->_template->getDocs();
        return $this->_template->createHTMLPage($docs);
    }
};