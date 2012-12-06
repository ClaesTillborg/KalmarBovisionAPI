<?php
namespace kalmarBovisionApi\apiInterface;

interface iKalmarBovisionApi {

    // Changed lists
    public function getChangedResidents();

    /**
     * @param \kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray
     * @return array of Resident-objects
     */
    public function getChangedResidentsByType(\kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray);

    // Registered lists
    public function getRegisteredResidents();

    /**
     * @param \kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray
     * @return array of Resident-objects
     */
    public function getRegisteredResidentsByType(\kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray);

    /**
     * let you set the coverage of your search
     *
     * @param \kalmarBovisionApi\model\Coverage $coverage
     * @return mixed
     */
    public function setCoverage($coverage);

    //Sorting functions
};