<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class View extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        
    }

    public function user($username) {
        $data = null;
        $this->load->model("user", '', TRUE);
        $this->load->model("stash", '', TRUE);

        $userObj = $this->user->selectByUsername($username);
        if (sizeof($userObj) == 1) {
            $data['userObj'] = $userObj[0];
            $stashes = $this->stash->selectByUserId($userObj[0]->USER_ID);
            $data['stashes'] = $stashes;
            $stashesCount = $this->stash->selectCountStashByUserId($userObj[0]->USER_ID);
            $data['stats']['stashes'] = $stashesCount[0]->TOTAL_STASH;
            
        } else {
            $this->session->set_flashdata('ERROR_MESSAGE', 'Sorry, the requested username is not found here.');
            $this->session->set_flashdata('backUrl', null);
            redirect("view/messageDisplay");
        }

        $this->load->view("template/head");
        $this->load->view("me/header");

        $this->load->view("me/home", $data);
    }

    public function messageDisplay() {
        $msg = $this->session->flashdata('ERROR_MESSAGE');
        $data['msg'] = $msg;
        $data['backUrl'] = $this->session->flashdata('backUrl');
        $this->load->view("template/head");
        $this->load->view("me/header");
        $this->load->view("me/messageDisplay", $data);
    }

    public function unstashed($username) {
        $this->load->model("posturl", '', TRUE);
        $this->load->model("user", '', TRUE);

        $userObj = $this->user->selectByUsername($username);

        if (sizeof($userObj) == 1) {
            $data['userObj'] = $userObj[0];
        } else {
            $this->session->set_flashdata('ERROR_MESSAGE', 'Sorry, the requested username is not found here.');
            $this->session->set_flashdata('backUrl', null);
            redirect("view/messageDisplay");
        }
        $links = $this->posturl->selectByUserIdNotDefined($userObj[0]->USER_ID);

        $data['links'] = $links;
        $this->load->view("template/head");
        $this->load->view("me/header");

        $this->load->view("me/unstashed", $data);
    }

    public function stash($stashId, $username) {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);
        $this->load->model("user", '', TRUE);

        $userObj = $this->user->selectByUsername($username);

        if (sizeof($userObj) == 1) {
            $data['userObj'] = $userObj[0];
            $stashes = $this->stash->selectByUserId($userObj[0]->USER_ID);
            $data['stashes'] = $stashes;
        } else {
            $this->session->set_flashdata('ERROR_MESSAGE', 'Sorry, the requested username is not found here.');
            $this->session->set_flashdata('backUrl', null);
            redirect("view/messageDisplay");
        }
        $links = $this->posturl->selectByUserIdStashId($userObj[0]->USER_ID, $stashId);
        $stashes = $this->stash->selectByUserId($userObj[0]->USER_ID);
        $stashObj = $this->stash->selectByUserIdAndStashId($userObj[0]->USER_ID, $stashId);

        if (sizeof($stashObj) == 0) {
            $this->session->set_flashdata('ERROR_MESSAGE', 'Sorry, we don\'t find the stash .');
            $this->session->set_flashdata('backUrl', "view/user/" . $username);
            redirect("view/messageDisplay");
        }

        $data['stashes'] = $stashes;
        $data['links'] = $links;
        $data['user'] = $user;
        $data['stashObj'] = $stashObj[0];
        $this->load->view("template/head");
        $this->load->view("me/header");

        $this->load->view("me/stash", $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
