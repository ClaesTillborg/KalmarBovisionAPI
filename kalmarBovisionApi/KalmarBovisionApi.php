<?php
namespace kalmarBovisionApi;

require_once(dirname(__FILE__) . "/interface/iKalmarBovisionApi.php");
//require_once(dirname(__FILE__) . "/model/KalmarBovisionApiDAL.php");
require_once(dirname(__FILE__) . "/model/Template.php");
//require_once(dirname(__FILE__) . "/model/ResidentType.php");

class KalmarBovisionApi implements \kalmarBovisionApi\apiInterface\iKalmarBovisionApi {

    // Private fields
    private $_DAL;
    private $_template = "";

	public function __construct() {

        // Create Template- and DAL-layer
        //$this->_DAL = new \kalmarBovisionApi\model\KalmarBovisioApiDAL();
        $this->_template = new \kalmarBovisionApi\model\Template();

	}

	public function getResidents() {
		// throw new notImplementedExeption();
	}

	public function getResidentsByType(\kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray) {
		// throw new notImplementedExeption();
	}

	public function getResidentType() {
		// throw new notImplementedExeption();
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