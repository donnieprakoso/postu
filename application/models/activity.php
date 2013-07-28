<?php

class Activity extends CI_Model {

    //private $selectAll = "select ACTIVITY.FLAG_TYPE,user.USERNAME, user.NAME,user.PROFILE_IMAGE_URL,post_url.POST_URL_ID, post_url.TEXT, post_url.URL_SHORT, post_url.CREATED_TIME,stash.STASH_ID, stash.NAME as STASH_NAME from ACTIVITY left join ( post_url left join stash on post_url.STASH_ID = stash.STASH_ID INNER JOIN user on post_url.USER_ID = user.USER_ID AND user.USER_ID <> ? ) on ACTIVITY.POST_URL_ID = post_url.POST_URL_ID ORDER BY CREATED_TIME DESC LIMIT ? , ?";
    private $selectAll = "select ACTIVITY.FLAG_TYPE,user.USERNAME, user.USER_ID,user.NAME,user.PROFILE_IMAGE_URL,post_url.POST_URL_ID, post_url.TEXT, post_url.URL_SHORT, post_url.CREATED_TIME from ACTIVITY INNER JOIN post_url on ACTIVITY.POST_URL_ID = post_url.POST_URL_ID INNER JOIN user ON ACTIVITY.USER_ID=user.USER_ID where ACTIVITY.USER_ID <> ? ORDER BY ACTIVITY.CREATED_TIME desc LIMIT ?,?";
    private $insert = "INSERT INTO ACTIVITY VALUES(?,?,?,?,now())";
    private $update = "";

    function __construct() {
        parent::__construct();
    }

    function update($userId, $stashId, $postUrlId) {
        $query = $this->db->query($this->updateSetStashIdByPostUrlId, array($stashId, $userId, $postUrlId));
    }

    function selectAll($userId, $page, $limit) {
        $page = ($page - 1) * $limit;
        $query = $this->db->query($this->selectAll, array($userId, $page, $limit));
        return $query->result();
    }

    function insert($userId, $postUrlId, $flagType) {
        $id = md5($userId . $postUrlId . $flagType . mktime());
        $query = $this->db->query($this->insert, array($id, $userId, $postUrlId, $flagType));
    }

}

?>
