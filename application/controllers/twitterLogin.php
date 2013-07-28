<?php

class TwitterLogin extends CI_Controller {

    function __construct() {
        parent::__construct();

        // It really is best to auto-load this library!
        $this->load->library('tweet');

        // Enabling debug will show you any errors in the calls you're making, e.g:
        $this->tweet->enable_debug(TRUE);

        // If you already have a token saved for your user
        // (In a db for example) - See line #37
        // 
        // You can set these tokens before calling logged_in to try using the existing tokens.
        // $tokens = array('oauth_token' => 'foo', 'oauth_token_secret' => 'bar');
        // $this->tweet->set_tokens($tokens);


        if (!$this->tweet->logged_in()) {


            $this->tweet->set_callback(site_url('twitterLogin/auth'));

            // Send the user off for login!
            $this->tweet->login();
        } else {
            // You can get the tokens for the active logged in user:
            // $tokens = $this->tweet->get_tokens();
            // 
            // These can be saved in a db alongside a user record
            // if you already have your own auth system.
        }
    }

    function index() {
        redirect("twitterLogin/auth");
    }

    function auth() {
        $this->load->library('session');
        $tokens = $this->tweet->get_tokens();
        $userTwt = $this->tweet->call('get', 'account/verify_credentials');
        $this->load->model("user", '', TRUE);

        if ($userTwt != null) {
            $userArray['name'] = $userTwt->name;
            $userArray['id'] = $userTwt->id_str;
            $userArray['image_url'] = $userTwt->profile_image_url;
            $userArray['screen_name'] = $userTwt->screen_name;
            $userArray['url'] = $userTwt->url;
            $userArray['description'] = $userTwt->description;
            $users = $this->user->selectById($userArray['id']);
            if (sizeof($users) == 0) {
                $this->user->insert($userTwt->id_str, $userTwt->screen_name, $userTwt->name, null, $tokens['oauth_token'], $tokens['oauth_token_secret'], $userTwt->profile_image_url, $userTwt->description, $userTwt->url);
            } else {
                $this->user->updateInfo($userTwt->screen_name, $userTwt->name, $userTwt->profile_image_url, $userTwt->description, $userTwt->url, $tokens['oauth_token'], $tokens['oauth_token_secret'], $userTwt->id_str);
            }
            $userId = $userTwt->id_str;
            $users = $this->user->selectById($userId);
            $userTwt = $users[0];
            $this->session->set_userdata("user", $userTwt);
            redirect("welcome/home");
        }
    }

}