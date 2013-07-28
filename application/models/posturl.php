<?php

class PostUrl extends CI_Model {

    private $selectOrderByDate = "SELECT POST_URL_ID,post_url.USER_ID, post_url.STASH_ID, URL_SHORT, URL_ORIGINAL, CATEGORY, TWEET_ID, TEXT, IS_PUBLIC, post_url.CREATED_TIME, stash.NAME as STASH_NAME FROM post_url LEFT JOIN stash ON post_url.STASH_ID = stash.STASH_ID WHERE post_url.USER_ID=? ORDER BY CREATED_TIME DESC LIMIT 10";
    private $selectLimitPage = "SELECT * FROM post_url LIMIT ?,?";
    private $select = "SELECT * FROM post_url ORDER BY CREATED_TIME DESC";
    private $selectByUserIdNotDefined = "SELECT * FROM post_url WHERE USER_ID=? and STASH_ID IS NULL ORDER BY CREATED_TIME DESC";
    private $selectCountByUserIdNotDefined = "SELECT count(0) as TOTAL_LINK FROM post_url WHERE USER_ID=? and STASH_ID IS NULL";
    private $selectByUserIdStashId = "SELECT * FROM post_url WHERE USER_ID=? and STASH_ID = ? ORDER BY CREATED_TIME DESC";
    private $selectByUserId = "SELECT * FROM post_url WHERE USER_ID=? ORDER BY CREATED_TIME DESC";
    private $insert = "INSERT INTO post_url VALUES(?,?,?,null,null,?,?,?,?,?,?,now())";
    private $insertRefer = "INSERT INTO post_url VALUES(?,?,?,?,?,?,?,?,?,?,?,now())";
    private $selectByUserIdAndPostUrlId = "SELECT * FROM post_url WHERE USER_ID=? and POST_URL_ID = ?";
    private $updateSetStashIdByPostUrlId = "UPDATE post_url SET STASH_ID = ? WHERE USER_ID= ? AND POST_URL_ID=?";
    private $selectFeaturedUserPostUrl = "select user.USER_ID,user.USERNAME,user.PROFILE_IMAGE_URL,post_url.URL_SHORT,post_url.TEXT,stash.NAME from post_url inner join user on post_url.USER_ID = user.USER_ID left join stash on post_url.STASH_ID = stash.STASH_ID and user.USER_ID= ?";
    private $selectByUserIdStashIdLimit = "SELECT * FROM post_url WHERE USER_ID=? and STASH_ID = ? ORDER BY CREATED_TIME DESC LIMIT ?";
    private $selectCountLinkByUserId = "SELECT count(0) as TOTAL_LINK from post_url WHERE USER_ID=?";
    private $selectCountLinkByUserIdAndStashId = "SELECT count(0) as TOTAL_LINK from post_url WHERE USER_ID=? AND STASH_ID=?";
    private $selectByUserIdLimit = "SELECT * FROM post_url WHERE USER_ID=? ORDER BY CREATED_TIME DESC LIMIT ?";
    private $selectByPosturlId = "SELECT * FROM post_url WHERE POST_URL_ID=? ORDER BY CREATED_TIME DESC";

    function __construct() {
        parent::__construct();
    }

    function insertRefer($userId, $stashId, $referUserId, $referStashId, $urlShort, $urlOriginal, $category, $tweetId, $text, $isPublic) {
        $postUrlId = md5($userId . $urlShort . $text . $referUserId . $referStashId . mktime());
        $query = $this->db->query($this->insertRefer, array($postUrlId, $userId, $stashId, $referUserId, $referStashId, $urlShort, $urlOriginal, $category, $tweetId, $text, $isPublic));
        return $postUrlId;
    }

    function selectByPosturlId($postUrlId) {
        $query = $this->db->query($this->selectByPosturlId, array($postUrlId));
        return $query->result();
    }

    function selectByUserIdLimit($userId, $limit) {
        $query = $this->db->query($this->selectByUserIdLimit, array($userId, $limit));
        return $query->result();
    }

    function selectCountByUserIdNotDefined($userId) {
        $query = $this->db->query($this->selectCountByUserIdNotDefined, array($userId));
        return $query->result();
    }

    function selectCountLinkByUserIdAndStashId($userId, $stashId) {
        $query = $this->db->query($this->selectCountLinkByUserIdAndStashId, array($userId, $stashId));
        return $query->result();
    }

    function selectCountLinkByUserId($userId) {
        $query = $this->db->query($this->selectCountLinkByUserId, array($userId));
        return $query->result();
    }

    function selectByUserIdStashIdLimit($userId, $stashId, $limit) {
        $query = $this->db->query($this->selectByUserIdStashIdLimit, array($userId, $stashId, $limit));
        return $query->result();
    }

    function updateSetStashIdByPostUrlId($userId, $stashId, $postUrlId) {
        $query = $this->db->query($this->updateSetStashIdByPostUrlId, array($stashId, $userId, $postUrlId));
    }

    function selectFeaturedUserPostUrl($userId) {
        $query = $this->db->query($this->selectFeaturedUserPostUrl, array($userId));
        return $query->result();
    }

    function selectByUserIdAndPostUrlId($userId, $postUrlId) {
        $query = $this->db->query($this->selectByUserIdAndPostUrlId, array($userId, $postUrlId));
        return $query->result();
    }

    function selectOrderByDate($userId) {
        $query = $this->db->query($this->selectOrderByDate, array($userId));
        return $query->result();
    }

    function selectLimitPage($page, $show) {
        $query = $this->db->query($this->selectLimitPage, array($page, $show));
        return $query->result();
    }

    function selectByUserIdStashId($userId, $stashId) {
        $query = $this->db->query($this->selectByUserIdStashId, array($userId, $stashId));
        return $query->result();
    }

    function selectByUserIdNotDefined($id) {
        $query = $this->db->query($this->selectByUserIdNotDefined, array($id));
        return $query->result();
    }

    function select() {
        $query = $this->db->query($this->select, array());
        return $query->result();
    }

    function selectByUserId($userId) {
        $query = $this->db->query($this->selectByUserId, array($userId));
        return $query->result();
    }

    function insert($userId, $stashId, $urlShort, $urlOriginal, $category, $tweetId, $text, $isPublic) {
        $postUrlId = md5($userId . $urlShort . $text . mktime());
        $query = $this->db->query($this->insert, array($postUrlId, $userId, $stashId, $urlShort, $urlOriginal, $category, $tweetId, $text, $isPublic));
        return $postUrlId;
    }

}

?>
