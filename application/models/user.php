<?php

class User extends CI_Model {

    private $selectById = "SELECT * FROM user WHERE USER_ID = ?";
    private $selectByIdPassword = "SELECT * FROM user WHERE USER_ID = ? AND PASSWORD = ?";
    private $insert = "INSERT INTO user VALUES(?,?,?,?,?,?,?,?,?,0, now())";
    private $updateInfo = "UPDATE user SET USERNAME = ?, NAME = ?, PROFILE_IMAGE_URL = ?, DESCRIPTION = ?, URL = ?, LAST_LOGIN= now() WHERE USER_ID = ?";
    private $updateAll = "UPDATE user SET USERNAME = ?, NAME = ?, PROFILE_IMAGE_URL = ?, DESCRIPTION = ?, URL = ?, TWT_OAUTH_TOKEN = ?, TWT_OAUTH_TOKEN_SECRET = ?, LAST_LOGIN= now() WHERE USER_ID = ?";
    private $updatePassword = "UPDATE user SET PASSWORD = ? WHERE USER_ID = ?";
    private $updateLogin = "UPDATE user SET LAST_LOGIN=now() WHERE USER_ID = ?";
    private $selectByUsername = "SELECT * FROM user WHERE USERNAME = ?";
    private $selectAllFeatured = "SELECT * FROM user WHERE IS_FEATURED = 1";

    function __construct() {
        parent::__construct();
    }

    function selectAllFeatured() {
        $query = $this->db->query($this->selectAllFeatured, array());
        return $query->result();
    }

    function selectByUsername($name) {
        $query = $this->db->query($this->selectByUsername, array($name));
        return $query->result();
    }

    function selectById($id) {
        $query = $this->db->query($this->selectById, array($id));
        return $query->result();
    }

    function selectByIdPassword($id, $password) {
        $query = $this->db->query($this->selectById, array($id, $password));
        return $query->result();
    }

    function insert($userId, $username, $name, $password, $oauthToken, $oauthTokenSecret, $profileImageUrl, $description, $url) {
        $query = $this->db->query($this->insert, array($userId, $username, $name, $password, $oauthToken, $oauthTokenSecret, $profileImageUrl, $description, $url));
    }

    function updateInfo($username, $name, $profileImageUrl, $description, $url, $oauthToken, $oauthTokenSecret, $userId) {
        $query = $this->db->query($this->updateAll, array($username, $name, $profileImageUrl, $description, $url, $oauthToken, $oauthTokenSecret, $userId));
    }

    function updatePassword($password, $userId) {
        $query = $this->db->query($this->updatePassword, array($password, $userId));
    }

    function updateLogin($userId) {
        $query = $this->db->query($this->updateLogin, array($userId));
    }

}

?>
