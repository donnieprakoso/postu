<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stash_Ops extends CI_Controller {

    public function index() {
        
    }

    public function add() {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $data['stashes'] = $stashes;
        $data['user'] = $user;

        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("stash_add", $data);
    }

    public function addProcess() {
        $name = $this->input->post("stash_name");

        $user = $this->session->userdata("user");
        if (!empty($name)) {
            if ($name[0] == "#") {
                $name = substr($name, 1);
            }
            $this->load->model("stash", '', TRUE);
            $stashObj = $this->stash->selectByUserIdName($user->USER_ID, $name);
            if (sizeof($stashObj) == 0) {
                $stashId = $this->stash->insert($user->USER_ID, $name, null);
            }
        } else {
            
        }
        redirect("welcome/stash/" . $stashId);
    }
    public function changeDesc($stashId,$backDesc) {        
        if($backDesc == "stashList")
        {
            $backUri = "/welcome/stashList";
        }
        else if($backDesc == "stash")
        {
            $backUri = "/welcome/stash/".$stashId;
        }        
        $data['backUri']=$backUri;
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $stashObj = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);

        $data['stashes'] = $stashes;
        $data['user'] = $user;
        $data['stashObj'] = $stashObj[0];
        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("stash_change", $data);
    }

    public function changeDescProcess() {
        $description = $this->input->post("stash_description");
        
        $backUri = $this->input->post("backUri");
        $stashId = $this->input->post("stash_id");
        if($backUri == "stashList")
        {
            $backUri = "/welcome/stashList";
        }
        else if($backUri == "stash")
        {
            $backUri = "/welcome/stash/".$stashId;
        }        
        $user = $this->session->userdata("user");
        if (!empty($description)) {
            
            $this->load->model("stash", '', TRUE);
            $stashObj = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);
            if (sizeof($stashObj) == 1) {
                $this->stash->updateDesc($description, $stashObj[0]->STASH_ID, $user->USER_ID);
            }
        } else {
            
        }
        if(!empty($backUri))
        {
            redirect($backUri);
        }
        else
        {
            redirect("welcome/stash/" . $stashId);
        }
    }

    public function rename($stashId,$backDesc) {        
        if($backDesc == "stashList")
        {
            $backUri = "/welcome/stashList";
        }
        else if($backDesc == "stash")
        {
            $backUri = "/welcome/stash/".$stashId;
        }        
        $data['backUri']=$backUri;
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $stashObj = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);

        $data['stashes'] = $stashes;
        $data['user'] = $user;
        $data['stashObj'] = $stashObj[0];
        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("stash_rename", $data);
    }

    public function renameProcess() {
        $name = $this->input->post("stash_rename");
        $stashId = $this->input->post("stash_id");

        $user = $this->session->userdata("user");
        if (!empty($name)) {
            if ($name[0] == "#") {
                $name = substr($name, 1);
            }
            $this->load->model("stash", '', TRUE);
            $stashObj = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);
            if (sizeof($stashObj) == 1) {
                $this->stash->updateName($name, $stashObj[0]->STASH_ID, $user->USER_ID);
            }
        } else {
            
        }
        redirect("welcome/stash/" . $stashId);
    }

    public function delete($stashId) {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $stashObj = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);

        $data['stashes'] = $stashes;
        $data['user'] = $user;
        $data['stashObj'] = $stashObj[0];
        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("stash_delete", $data);
    }

    public function deleteProcess($id) {

        $stashId = $this->input->post("stash_id");

        $user = $this->session->userdata("user");
        if (!empty($name)) {
            if ($name[0] == "#") {
                $name = substr($name, 1);
            }
            $this->load->model("stash", '', TRUE);
            $stashObj = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);
            if (sizeof($stashObj) == 1) {
                $this->stash->updateName($name, $stashObj[0]->STASH_ID, $user->USER_ID);
            }
        } else {
            
        }
        redirect("welcome/stash/" . $stashId);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */