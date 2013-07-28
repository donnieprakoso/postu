<?php

class User_Featured extends CI_Model {

    private $selectLimit = "SELECT * FROM USER_FEATURED LIMIT ?";
    
    function __construct() {
        parent::__construct();
    }

    function selectLimit($limit) {
        $query = $this->db->query($this->selectLimit, array($limit));
        return $query->result();
    }


}

?>
