<?php
namespace kalmarBovisionApi\model;

require_once(dirname(__FILE__) . "/../interface/iResident.php");

class Resident implements \kalmarBovisionApi\apiInterface\iResident {

	// Properties
	public $_title = "";
	public $_link = "";
	public $_desc = "";
	public $_author = "";
	public $_date;

    /**
     * Creates and returns a Resident-object with the information.
     *
     * @param $title
     * @param $link
     * @param $desc
     * @param $author
     * @param $date
     */
    public function __construct($title, $link, $desc, $author, $date) {
        $this->_title = $title;
        $this->_link = $link;
        $this->_desc = $desc;
        $this->_author = $author;
        if(is_string($date)) {
            $this->_date = new \DateTime($date);
        }else{
            $this->_date = $date;
        }

	}

    /**
     * @return string title
     */
    public function getTitle() {

        return $this->_title;
    }

    /**
     * @return string link
     */
    public function getLink() {

        return $this->_link;
    }

    /**
     * @return string description
     */
    public function getDescription() {

        return $this->_desc;
    }

    /**
     * @return string author
     */
    public function getAuthor() {

        return $this->_author;
    }

    /**
     * @return \DateTime date
     */
    public function getDate() {

        return $this->_date;
    }
	
}