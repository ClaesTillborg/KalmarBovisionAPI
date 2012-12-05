<?php

require_once(dirname(__FILE__) . "/kalmarBovisionApi/KalmarBovisionApi.php");

$myApi = new \kalmarBovisionApi\KalmarBovisionApi();

echo $myApi->apiDocs();