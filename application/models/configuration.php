<?php

class Configuration extends CI_Model {

    private $selectByName= "SELECT * FROM configuration WHERE NAME = ?";
    private $update = "UPDATE configuration SET VALUE = ? WHERE NAME = ?";
    function __construct() {
        parent::__construct();
    }

    function selectByName($name) {
        $query = $this->db->query($this->selectByName, array($name));
        return $query->result();
    }

    function update($value, $name) {
        $query = $this->db->query($this->update, array($value, $name));
    }

}

?>
