<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Posturl_Ops extends CI_Controller {

    public function index() {
        
    }

    public function relink($postUrlId, $referUserId, $backDesc) {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);
        $postUrlObj = $this->posturl->selectByPosturlId($postUrlId);
        if ($backDesc == "home") {
            $backUri = "welcome/home";
        } else if ($backDesc == "people") {
            $backUri = "people/view/" . $referUserId;
        } else if ($backDesc == "peopleStash") {
            $backUri = "people/stash/" . $referUserId . "/" . $postUrlObj[0]->STASH_ID;
        }

        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $data['backUri'] = $backUri;
        $data['backDesc'] = $backDesc;
        if (sizeof($postUrlObj) == 1) {
            $data['stashes'] = $stashes;
            $data['user'] = $user;
            $data['link'] = $postUrlObj[0];
            $this->load->view("template/head");
            $this->load->view("template/header");
            $this->load->view("template/stashLink", $data);
            $this->load->view("posturl_relink", $data);
        } else {
            
        }
    }

    public function relinkProcess($postUrlId, $stashId, $backDesc) {
        $user = $this->session->userdata("user");
        $this->load->model("activity", '', TRUE);

        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);

        $stashes = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);
        $postUrlObj = $this->posturl->selectByPostUrlId($postUrlId);
        if ($backDesc == "home") {
            $backUri = "welcome/home";
        } else if ($backDesc == "people") {
            $backUri = "people/view/" . $postUrlObj[0]->USER_ID;
        } else if ($backDesc == "peopleStash") {
            $backUri = "people/stash/" . $postUrlObj[0]->USER_ID . "/" . $postUrlObj[0]->STASH_ID;
        }

        if (sizeof($postUrlObj) == 1 && sizeof($stashes) == 1) {
            $postUrlObject = $postUrlObj[0];
            $this->posturl->insertRefer($user->USER_ID, $stashId, $postUrlObject->USER_ID, $postUrlObject->STASH_ID, $postUrlObject->URL_SHORT, $postUrlObject->URL_ORIGINAL, $postUrlObject->CATEGORY, $postUrlObject->TWEET_ID, $postUrlObject->TEXT, 1);
            $this->activity->insert($user->USER_ID, $postUrlId, 2);
            redirect($backUri);
        } else {
            redirect("welcome/home");
        }
    }

    public function move($posturlId) {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);

        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $postUrlObj = $this->posturl->selectByUserIdAndPostUrlId($user->USER_ID, $posturlId);
        if (sizeof($postUrlObj) == 1) {
            $data['stashes'] = $stashes;
            $data['user'] = $user;
            $data['link'] = $postUrlObj[0];
            $this->load->view("template/head");
            $this->load->view("template/header");
            $this->load->view("template/stashLink", $data);
            $this->load->view("posturl_move", $data);
        } else {
            redirect("welcome/unstashed");
        }
    }

    public function moveProcess($posturlId, $stashId) {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);

        $stashes = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);
        $postUrlObj = $this->posturl->selectByUserIdAndPostUrlId($user->USER_ID, $posturlId);
        if (sizeof($postUrlObj) == 1 && sizeof($stashes) == 1) {
            $this->posturl->updateSetStashIdByPostUrlId($user->USER_ID, $stashId, $posturlId);
            redirect("welcome/stash/" . $stashes[0]->STASH_ID);
        } else {
            redirect("welcome/unstashed");
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */