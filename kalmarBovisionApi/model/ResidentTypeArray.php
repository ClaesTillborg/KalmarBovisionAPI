<?php
namespace kalmarBovisionApi\model;

class ResidentTypeArray {

    private $_residentTypeArray;

    /**
     * Initiate by setting type to all
     */
    public function __construct() {
        $this->_residentTypeArray = array(ResidentType::all);
    }

    /**
     * @param ResidentType $residentType Enum
     */
    public function addType($residentType) {


        if($this->isResidentType($residentType)){
            if(!in_array($residentType, $this->_residentTypeArray)) {
                if($residentType === ResidentType::all || $this->_residentTypeArray[0] === ResidentType::all) {
                    $this->_residentTypeArray = [];
                }
                array_push($this->_residentTypeArray, $residentType);
            }
        }

    }

    /**
     * @return array(ResidentType)
     */
    public function getTypeArray() {
        return $this->_residentTypeArray;
    }

    /**
     * Set the array to default
     */
    public function setToDefault() {
        $this->addType(ResidentType::all);
    }

    /**
     * Check if it's a ResidentType enum
     */
    private function isResidentType($type) {
        if($type === ResidentType::all ||
            $type === ResidentType::villa ||
            $type === ResidentType::holidayHouse ||
            $type === ResidentType::farm ||
            $type === ResidentType::apartment ||
            $type === ResidentType::rentedApartment ||
            $type === ResidentType::sublet ||
            $type === ResidentType::land ||
            $type === ResidentType::parking ||
            $type === ResidentType::student) {
            return true;
        }
        return false;
    }

};