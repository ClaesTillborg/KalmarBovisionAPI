<?php
namespace kalmarBovisionApi\model;

require_once "model/Resident.php";
require_once "model/Coverage.php";

class KalmarBovisioApiDAL implements \kalmarBovisionApi\apiInterface\iKalmarBovisionApi {


    function __construct() {}

    /**
     * takes the url-components and return the composed url
     *
     * @param ResidentTypeArray $residentTypeArray
     * @param $filter
     * @param $coverage
     * @return string
     */
    private function setUrl(ResidentTypeArray $residentTypeArray, $filter, $coverage) {
        $typeString = "";
        foreach($residentTypeArray as $type){
            $typeString .= $type;
        }
        return "http://bovision.se/Rss?t=${typeString}&on=${filter}&dlv=1&ea=${coverage}";
    }

    /**
     * Creates a Resident-object
     *
     * @param $node
     * @return Resident $item
     */
    private function createObj($node) {
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

    public function getResidents() {

    }


	public function getResidentsByType(ResidentTypeArray $residentTypeArray) {
		$feed = array();
		$rss = new \DOMDocument();

		$rss->load("http://bovision.se/Rss?t=${residentType}&on=Changed&dlv=1&ea=ac:880");

		foreach ($rss->getElementsByTagName('item') as $node) {

			$item = $this->createObj($node);
			var_dump($item);
			$item = $this->createJson($node);
			var_dump($item);
			die();

			array_push($feed, $item);
		//return $feed;
		};
	}
};
