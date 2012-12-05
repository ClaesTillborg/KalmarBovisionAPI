<?php

namespace kalmarBovisionApi\test;

// Files included in the tests
require_once(dirname(__FILE__) . "/simpletest/autorun.php");
require_once(dirname(__FILE__) . "/../model/ResidentType.php");
require_once(dirname(__FILE__) . "/../model/ResidentTypeArray.php");
require_once(dirname(__FILE__) . "/../model/Resident.php");

// Files performing tests
include_once(dirname(__FILE__) . "/ResidentTypeArrayTests.php");
include_once(dirname(__FILE__) . "/ResidentTests.php");




?>