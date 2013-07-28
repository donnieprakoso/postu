<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ipostit extends CI_Controller {

    public function index() {
        $this->load->view('welcome_message');
    }

    public function post() {
        $this->load->model("posturl", '', TRUE);
        $user = $this->session->userdata("post_user");
        $short_url = $this->session->userdata("short_url");
        $url = $this->session->userdata("url");
        $tweet = $this->input->post("tweet");
        $stash = $this->input->post("stash");
        $toTweet = $this->input->post("to_twitter");
        if (empty($stash)) {
            $stash = NULL;
        }
        $category = "LINK";
        //define category
        $image = array('png', 'jpg', 'gif');
        $ext = substr($url, -3);
        if (in_array($ext, $image)) {
            $category = "PICTURE";
        }
        //end define category
        $isPublic = 1;
        $isTweeted = 1;
        if (empty($toTweet)) {
            $isTweeted = 0;
        }
        if (!is_null($url) && !is_null($user)) {
            if ($isTweeted == 1) {
                $tokens = array('oauth_token' => $user->TWT_OAUTH_TOKEN, 'oauth_token_secret' => $user->TWT_OAUTH_TOKEN_SECRET);
                $this->tweet->set_tokens($tokens);
                $response = $this->tweet->call('post', 'statuses/update', array('status' => $tweet));
                $tweetId = $response->id_str;
            } else {
                $tweetId = null;
            }
            $postUrlId = $this->posturl->insert($user->USER_ID, $stash, $short_url, $url, $category, $tweetId, $tweet, $isPublic);
            $this->load->model("activity", '', TRUE);
            $this->activity->insert($user->USER_ID, $postUrlId, 1);
            //$this->posturl->insert($user->USER_ID, $short_url, $url, $category, $tweetId, $tweet, $isPublic);
            //$this->session->sess_destroy();
            //$data['response'] = $response;
            $this->load->view("bookmarklet/head");
            $this->load->view("bookmarklet/header");
            $this->load->view("post_process");
            $this->load->view("bookmarklet/footer");
        } else {
            
        }
    }

    public function postmaster() {
//        require_once('/var/www/postlink/res/lib/simple_html_dom.php');
        $this->load->library('encrypt');
        $this->load->library('bitly');
        $this->load->model('user', '', TRUE);

        $query = explode('&', $_SERVER['QUERY_STRING']);
        $params = array();
        foreach ($query as $param) {
            list($name, $value) = explode('=', $param);
            $params[urldecode($name)][] = urldecode($value);
        }


        $query = $_SERVER['QUERY_STRING'];
        $url = $_GET['url'];
        $code = $_GET['m'];
        $title = $_GET['title'];
        if (isset($params['img'])) {
            $img = $params['img'];
        }
        //$code = str_replace("!@!", "+", $code);

        $data['m'] = $code;
        $data['url'] = $url;

        $data['title'] = trim($title);

        $images = array();
        $targetBaseUrl = parse_url($url);
        $targetHostUrl = $targetBaseUrl['scheme'] . "://" . $targetBaseUrl['host'];
        if (isset($img)) {
            for ($i = 0; $i < sizeof($img); $i++) {
                $testUrl = parse_url($img[$i]);
                if (!array_key_exists('host', $testUrl)) {
                    //$imageUrl = $targetHostUrl . "/" . $element->src;
                    $imageUrl = $targetHostUrl . "/" . $testUrl['path'];
                    if (array_key_exists('query', $testUrl)) {
                        $imageUrl.="?" . $testUrl['query'];
                    }
                } else {
                    $imageUrl = $img[$i];
                }
                array_push($images, $imageUrl);
            }
        }
        $data['images'] = $images;

        $this->load->view("bookmarklet/head");
        $this->load->view("bookmarklet/header");
        $this->load->view("post_view", $data);
        $this->load->view("bookmarklet/footer");
    }

    public function postGo() {
        $this->load->library('encrypt');
        $this->load->library('bitly');
        $this->load->model('user', '', TRUE);
        $this->load->model('stash', '', TRUE);
        $query = $_SERVER['QUERY_STRING'];

        $url = $_GET['url'];
        $code = $_GET['m'];
        $type = $_GET['type'];
        if ($type == "link") {
            $title = $_GET['title'];
        }

        $code = str_replace("!@!", "+", $code);
        $key = 'insane-postLink';
        $message = $this->encrypt->decode($code, $key);

        $parsed = explode("&", $message);
        $id = $parsed[0];
        $password = $parsed[1];
        $user = $this->user->selectByIdPassword($id, $password);
        if (is_null($user)) {
            $mode = "NO_USER";
        } else {
            if (sizeof($user) == 0) {
                $mode = "NO_USER";
            } else {
                $shorten_request = $this->bitly->call('shorten', array('longUrl' => $url));
                $short_url = trim($shorten_request->__resp->data->data->url);
                $data['user'] = $user[0];
                $data['url'] = $url;
                if ($type == "link") {
                    $data['title'] = trim($title);
                }
                $data['type'] = $type;
                $data['short_url'] = $short_url;
                $stashes = $this->stash->selectByUserId($user[0]->USER_ID);
                $data['stashes'] = $stashes;
                $this->session->set_userdata("post_user", $user[0]);
                $this->session->set_userdata("short_url", $short_url);
                $this->session->set_userdata("url", $url);
                $this->load->view("bookmarklet/head");
                $this->load->view("bookmarklet/header");
                $this->load->view("post", $data);
                $this->load->view("bookmarklet/footer");
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
