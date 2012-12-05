<?php
namespace kalmarBovisionApi\apiInterface;

interface iKalmarBovisionApi {
    public function getResidents();
    public function getResidentsByType(\kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray);
};