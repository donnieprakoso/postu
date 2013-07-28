<?php

class Stash extends CI_Model {

    private $selectById = "SELECT * FROM stash WHERE STASH_ID = ?";
    private $selectByUserId = "SELECT * FROM stash WHERE USER_ID = ? ORDER BY NAME ASC";
    private $selectByUserIdName = "SELECT * FROM stash WHERE USER_ID = ? AND NAME=?";
    private $insert = "INSERT INTO stash VALUES(?,?,?,?,now())";
    private $selectByUserIdAndStashId = "SELECT * FROM stash WHERE USER_ID = ? and STASH_ID=?";
    private $updateNameById = "UPDATE stash set NAME = ? WHERE STASH_ID=? and USER_ID=?";
    private $updateDescById = "UPDATE stash set DESCRIPTION = ? WHERE STASH_ID=? and USER_ID=?";
    private $deleteById = "DELETE from stash WHERE STASH_ID=? and USER_ID=?";
    private $selectCountStashByUserId = "SELECT count(0) as TOTAL_STASH from stash WHERE USER_ID=?";

    function __construct() {
        parent::__construct();
    }

    function selectCountStashByUserId($id) {
        $query = $this->db->query($this->selectCountStashByUserId, array($id));
        return $query->result();
    }

    function selectById($id) {
        $query = $this->db->query($this->selectById, array($id));
        return $query->result();
    }

    function selectByUserId($userId) {
        $query = $this->db->query($this->selectByUserId, array($userId));
        return $query->result();
    }

    function selectByUserIdName($userId, $name) {
        $query = $this->db->query($this->selectByUserIdName, array($userId, $name));
        return $query->result();
    }

    function selectByUserIdAndStashId($userId, $stashId) {
        $query = $this->db->query($this->selectByUserIdAndStashId, array($userId, $stashId));
        return $query->result();
    }

    function insert($userId, $name, $description) {
        $stashId = md5($userId . $name . $description . mktime());
        $query = $this->db->query($this->insert, array($stashId, $userId, $name, $description));
        return $stashId;
    }

    function updateName($name, $stashId, $userId) {
        $query = $this->db->query($this->updateNameById, array($name, $stashId, $userId));
    }

    function updateDesc($desc, $stashId, $userId) {
        $query = $this->db->query($this->updateDescById, array($desc, $stashId, $userId));
    }

    function delete($stashId, $userId) {
        $query = $this->db->query($this->deleteById, array($stashId, $userId));
    }

}

?>
