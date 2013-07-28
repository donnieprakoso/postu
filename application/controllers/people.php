<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class People extends CI_Controller {

    public function index() {
        
    }

    public function view($userId) {
        $user = $this->session->userdata("user");
        $this->load->model("user", '', TRUE);
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);
        $people = $this->user->selectById($userId);
        if ($people == null) {
            
        }
        if (sizeof($people) != 1) {
            
        }
        $people = $people[0];
        $stashes = $this->stash->selectByUserId($people->USER_ID);
        for ($i = 0; $i < sizeof($stashes); $i++) {
            $stashes[$i]->LINKS = $this->posturl->selectByUserIdStashIdLimit($people->USER_ID, $stashes[$i]->STASH_ID, 5);
        }
        $stashesCount = $this->stash->selectCountStashByUserId($people->USER_ID);
        $linksCount = $this->posturl->selectCountLinkByUserId($people->USER_ID);
        $data['stashes'] = $stashes;
        $data['user'] = $user;
        $data['people'] = $people;
        $data['stats']['links'] = $linksCount[0]->TOTAL_LINK;
        $data['stats']['stashes'] = $stashesCount[0]->TOTAL_STASH;
        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("people/view", $data);
        //    $this->load->view("home", $data);
    }

    public function stash($userId, $stashId) {
        $user = $this->session->userdata("user");
        $this->load->model("user", '', TRUE);
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);
        $people = $this->user->selectById($userId);
        if ($people == null) {
            
        }
        if (sizeof($people) != 1) {
            
        }
        $people = $people[0];
        $stashes = $this->stash->selectByUserIdAndStashId($people->USER_ID,$stashId);
        $linksCount = $this->posturl->selectCountLinkByUserIdAndStashId($people->USER_ID,$stashId);
        $links = $this->posturl->selectByUserIdStashId($people->USER_ID,$stashId);
        $data['stashes'] = $stashes[0];
        $data['user'] = $user;
        $data['people'] = $people;
        $data['stats']['links'] = $linksCount[0]->TOTAL_LINK;
        $data['links']=$links;
        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("people/view_stash", $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
