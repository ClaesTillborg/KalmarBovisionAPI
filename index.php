<?php

/**
 * 1. Require the API to your project
 */
require_once("kalmarBovisionApi/KalmarBovisionApi.php");

/**
 * 2. Create an instance och the KalmarBovisionApi-class.
 */
$myApi = new \kalmarBovisionApi\KalmarBovisionApi();

/**
 * 3. This is a function that renders the API's documentation.
 *    It is not essential to your project so change this to your
 */
echo $myApi->apiDocs();