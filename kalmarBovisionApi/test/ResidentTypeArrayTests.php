<?php

namespace kalmarBovisionApi\test;

/**
 * Testing the ResidentTypeArray
 */
class ResidentTypeArrayTests extends \UnitTestCase {

    // Private field
    private $_residentTypeArray;

    function setUp() {
        // Create new ResidentTypeArray
        $this->_residentTypeArray = new \kalmarBovisionApi\model\ResidentTypeArray();
    }

    function tearDown() {
        // Unset the variable
        unset($this->_residentTypeArray);
    }

    /**
     * Testing to fetch the array
     *
     * @return array
     */
    function testGettingTypeArray() {

        // Fetch the array
        $result = $this->_residentTypeArray->getTypeArray();

        // Return an array
        $this->assertEqual(is_array($result), "Did not return an array");

        // The array contains something
        $this->assertNotEqual(count($result), 0, "Array didn't contain anything");

        return $result;
    }

    /**
     * Check if last index in the array contains the correct ResidentType
     *
     * @param $typeArray
     * @param $type
     */
    function checkType($typeArray, $type) {

        // The array contains a ResidentType enum
        $this->assertIdentical(end($typeArray), $type, "Array didn't contain the right ResidentType");
    }

    /**
     * Check that the newly created array is an array and contains a ResidentType::all
     */
    function testDefaultType() {

        $result = $this->testGettingTypeArray();

        $this->checkType($result, \kalmarBovisionApi\model\ResidentType::all);
    }

    /**
     * Try adding a villa enum to the array
     */
    function testAddingAType() {

        // Try adding ResidentType enum
        $this->_residentTypeArray->addType(\kalmarBovisionApi\model\ResidentType::villa);

        // Try adding other than ResidentType enum
        $this->_residentTypeArray->addType("villa");

        $result = $this->testGettingTypeArray();

        $this->checkType($result, \kalmarBovisionApi\model\ResidentType::villa);
    }

    /**
     * Try adding multiple enums
     */
    function testAddingMultipleTypes() {

        // Try adding same ResidentType enum
        $this->_residentTypeArray->addType(\kalmarBovisionApi\model\ResidentType::villa);
        $result = $this->testGettingTypeArray();

        // The array count should not increase
        $this->assertNotEqual(count($result), 2, "Array count should not increase");

        // Try adding new ResidentType enum
        $this->_residentTypeArray->addType(\kalmarBovisionApi\model\ResidentType::apartment);
        $result = $this->testGettingTypeArray();
        $this->checkType($result, \kalmarBovisionApi\model\ResidentType::apartment);

        // The array count should increase by one
        $this->assertEqual(count($result), 2, "Array count didn't increase");

        // Try adding new ResidentType enum
        $this->_residentTypeArray->addType(\kalmarBovisionApi\model\ResidentType::farm);
        $result = $this->testGettingTypeArray();
        $this->checkType($result, \kalmarBovisionApi\model\ResidentType::farm);

        // The array count should increase by one
        $this->assertEqual(count($result), 3, "Array count didn't increase");

        // Try adding ResidentType::all
        $this->_residentTypeArray->addType(\kalmarBovisionApi\model\ResidentType::all);
        $result = $this->testGettingTypeArray();
        $this->checkType($result, \kalmarBovisionApi\model\ResidentType::all);

        // The array should only include one ResidentType::all
        $this->assertEqual(count($result), 1, "Array didn't change to default");

    }
};
?>