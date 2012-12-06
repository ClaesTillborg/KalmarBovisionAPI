<?php
namespace kalmarBovisionApi\model;

require_once(dirname(__FILE__) . "/Resident.php");
require_once(dirname(__FILE__) . "/Filter.php");

class KalmarBovisioApiDAL implements \kalmarBovisionApi\apiInterface\iKalmarBovisionApi {

    private $_coverage;

    /**
     * Set coverage to county
     */
    function __construct() {

        $this->_coverage = Coverage::county;
    }

    /**
     * takes the url-components and return the composed url
     *
     * @param ResidentTypeArray $residentTypeArray
     * @param $filter
     * @param $coverage
     * @return string
     */
    private function setUrl(ResidentTypeArray $residentTypeArray, $filter, $coverage) {

        // Fetch the array from the object
        $typeArray = $residentTypeArray->getTypeArray();
        $typeString = $typeArray[0];

        if(count($typeArray) > 1){
            $typeString = "";
            foreach($typeArray as $type){
                if($typeArray[0] === $type) {
                    $typeString .= "${type}";
                } else {
                    $typeString .= ",${type}";
                }

            }
        }

        return "http://bovision.se/Rss?t=${typeString}&on=${filter}&dlv=1&ea=${coverage}";
    }

    /**
     * @param $url
     * @return array of Resident-objects
     */
    private function getFeed($url) {
        $feed = array();
        $rss = new \DOMDocument();
        $rss->load($url);

        foreach ($rss->getElementsByTagName('item') as $node) {
            array_push($feed, $this->createPHPObj($node));
        };
        return $feed;
    }

    /**
     * Creates a Resident-object
     *
     * @param $node
     * @return Resident $item
     */
    private function createPHPObj($node) {
        $item = new Resident(
            $node->getElementsByTagName('title')->item(0)->nodeValue,
            $node->getElementsByTagName('link')->item(0)->nodeValue,
            $node->getElementsByTagName('description')->item(0)->nodeValue,
            $node->getElementsByTagName('author')->item(0)->nodeValue,
            $node->getElementsByTagName('pubDate')->item(0)->nodeValue);

        return $item;
    }

    /**
     * Creates a json-object
     *
     * @param $node
     * @return string(json-object) $item
     */
    private function createJson($node) {
        $item = array(
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'author' => $node->getElementsByTagName('author')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        return json_encode($item, JSON_FORCE_OBJECT);
    }

    // Registered lists
    public function getRegisteredResidents() {
        $url = $this->setUrl(new ResidentTypeArray(), Filter::newlyRegistered, $this->_coverage);
        return $this->getFeed($url);
    }

    /**
     * @param \kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray
     * @return array of Resident-objects
     */
    public function getRegisteredResidentsByType(ResidentTypeArray $residentTypeArray) {
        $url = $this->setUrl($residentTypeArray, Filter::newlyRegistered, $this->_coverage);
        return $this->getFeed($url);
    }


    // Changed lists
    public function getChangedResidents() {
        $url = $this->setUrl(new ResidentTypeArray(), Filter::registeredAndChanged, $this->_coverage);
        return $this->getFeed($url);
    }

    /**
     * @param \kalmarBovisionApi\model\ResidentTypeArray $residentTypeArray
     * @return array of Resident-objects
     */
    public function getChangedResidentsByType(ResidentTypeArray $residentTypeArray) {
        $url = $this->setUrl($residentTypeArray, Filter::registeredAndChanged, $this->_coverage);
        return $this->getFeed($url);
    }

    /**
     * let you set the coverage of your search
     *
     * @param \kalmarBovisionApi\model\Coverage $coverage
     * @return mixed
     */
    public function setCoverage($coverage){
        $this->_coverage = $coverage;
    }
};
