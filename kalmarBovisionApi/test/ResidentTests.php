<?php
namespace kalmarBovisionApi\test;

/**
 * Testing the Resident-object
 */
class ResidentTests extends \UnitTestCase {

    // Private field
    private $_resident;
    private $_now;

    function setUp() {

        // Set date to now
        $this->_now = new \DateTime();

        // Create new ResidentTypeArray
        $this->_resident = new \kalmarBovisionApi\model\Resident("test-title", "test-link","test-description","test-author", $this->_now);
    }

    function tearDown() {
        // Unset the variables
        unset($this->_resident);
        unset($this->_now);
    }

    /**
     * Testing the property-values of the Resident-object
     */
    function testObjectValues() {

        $resident = $this->_resident;

        // Test if a Resident-object is created
        $this->assertIsA($resident, "kalmarBovisionApi\model\Resident", "A Resident-object was not created");

        // Check values
        $this->assertEqual($resident->_title, "test-title", "Not correct value on title");
        $this->assertEqual($resident->_link, "test-link", "Not correct value on link");
        $this->assertEqual($resident->_desc, "test-description", "Not correct value on description");
        $this->assertEqual($resident->_author, "test-author", "Not correct value on author");

        // Check date value
        $this->assertIsA($resident->_date, "DateTime", "Date a DateTime-object");
        $this->assertEqual($resident->_date, $this->_now, "Not correct value on date");

    }

    /**
     * Testing the get-functions och the properties
     */
    function testGetFunctions() {
        $resident = $this->_resident;
        $date = $resident->getDate();

        // Check values
        $this->assertEqual($resident->getTitle(), "test-title", "Not correct value on title");
        $this->assertEqual($resident->getLink(), "test-link", "Not correct value on link");
        $this->assertEqual($resident->getDescription(), "test-description", "Not correct value on description");
        $this->assertEqual($resident->getAuthor(), "test-author", "Not correct value on author");

        // Check date value
        $this->assertIsA($date, "DateTime", "Date a DateTime-object");
        $this->assertEqual($date, $this->_now, "Not correct value on date");

    }
}
