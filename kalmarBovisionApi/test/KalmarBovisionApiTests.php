<?php
namespace kalmarBovisionApi\test;

/**
 * Testing the KalmarbovisionApi-class and its DAL-version
 */
class KalmarBovisionApiTests extends \UnitTestCase {

    // Private field
    private $_api;
    private $_dal;
    private $_result;

    function setUp() {

        // Start API
        $this->_api = new \kalmarBovisionApi\KalmarBovisionApi();
    }

    function tearDown() {
        // Unset the variables
        unset($this->_api);
        unset($this->_dal);
    }

    /**
     * Controlls the array
     */
    private function checkArray(){

        $this->assertIsA($this->_result, "Array", "The function didn't return an array");
        $this->assertTrue(count($this->_result) > 0, "The array is empty");
        $this->assertIsA($this->_result[0], "\kalmarBovisionApi\model\Resident", "The array didn't contain Resident-objects");
    }

    /**
     *
     *  API-TESTING
     *
     */

    /**
     *
     */
    function testGetResidents() {

        $this->_result = $this->_api->getChangedResidents();
        $this->checkArray();

        $this->_result = $this->_api->getRegisteredResidents();
        $this->checkArray();
    }

    /**
     *
     */
    function testGetResidentsByType() {

        // Create an ResidenTypeArray-object
        $typeArray = new \kalmarBovisionApi\model\ResidentTypeArray();

        // Test getting residents on default value
        $this->_result = $this->_api->getChangedResidentsByType($typeArray);
        $this->checkArray();

        $this->_result = $this->_api->getRegisteredResidentsByType($typeArray);
        $this->checkArray();

        // Test changing coverage to commune and fetch
        $this->_api->setCoverage(\kalmarBovisionApi\model\Coverage::commune);

        // Test getting residents on default value
        $this->_result = $this->_api->getChangedResidentsByType($typeArray);
        $this->checkArray();

        $this->_result = $this->_api->getRegisteredResidentsByType($typeArray);
        $this->checkArray();

        // Test fetching with multiple residenttypes
        $typeArray->addType(\kalmarBovisionApi\model\ResidentType::apartment);
        $typeArray->addType(\kalmarBovisionApi\model\ResidentType::farm);

        $this->_result = $this->_api->getChangedResidentsByType($typeArray);
        $this->checkArray();

        $this->_result = $this->_api->getRegisteredResidentsByType($typeArray);
        $this->checkArray();

        // Test changing coverage to city and fetch
        $this->_api->setCoverage(\kalmarBovisionApi\model\Coverage::city);

        // Test getting residents on default value
        $this->_result = $this->_api->getChangedResidentsByType($typeArray);
        $this->checkArray();

        $this->_result = $this->_api->getRegisteredResidentsByType($typeArray);
        $this->checkArray();
    }

}
