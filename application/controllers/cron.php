<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends CI_Controller {

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

    public function processMessages() {
        require_once("/home/postuus/public_html/res/lib/Twitter/Extractor.php");
        $this->load->model("posturl", '', TRUE);
        $this->load->model("user", '', TRUE);
        $this->load->model("stash", '', TRUE);
        $this->load->model("configuration", '', TRUE);
        $configuration = $this->configuration->selectByName("TWT_MESSAGE_SINCE_ID");
        $sinceId = $configuration[0]->VALUE;
        $tokens = array('oauth_token' => "426511615-niNRKMf0Q39nAMt1DZZwg8oBqrb5rby7H58bDdDN", 'oauth_token_secret' => "vYhQUoUVuHrBwXkWQ309HiiKwpopBWbgeWWNBaFXY");
        $this->tweet->set_tokens($tokens);
        if ($sinceId == 0) {
            $responses = $this->tweet->call('get', '1/direct_messages', array('count' => 10));
        } else {
            $responses = $this->tweet->call('get', '1/direct_messages', array('since_id' => $sinceId, 'count' => 10));
        }
        for ($i = 0; $i < sizeof($responses); $i++) {
            $response = $responses[$i];
            echo "PROCESSING : " . $response->id_str;
            echo "\n";
            $tweet = Twitter_Extractor::create($response->text)->extract();
            if (sizeof($tweet['urls']) > 0) {
                $urlTweet = $tweet['urls'][0];
                if (sizeof($tweet['hashtags']) > 0) {
                    $stashName = $tweet['hashtags'][0];
                }
                $userId = $response->sender->id_str;
                $username = $response->sender->screen_name;
                $name = $response->sender->name;
                $password = null;
                $oauthToken = null;
                $oauthTokenSecret = null;
                $profileImageUrl = $response->sender->profile_image_url;
                $description = $response->sender->description;
                $url = $response->sender->url;
                $users = $this->user->selectById($userId);
                if (sizeof($users) == 0) {
                    $this->user->insert($userId, $username, $name, $password, $oauthToken, $oauthTokenSecret, $profileImageUrl, $description, $url);
                }
                $stashes = $this->stash->selectByUserIdName($userId, $stashName);
                if (sizeof($stashes) == 0) {
                    $stashId = $this->stash->insert($userId, $stashName, null);
                } else {
                    $stashId = $stashes[0]->STASH_ID;
                }
                $urlShort = $urlTweet;
                $urlOriginal = null;
                $category = "LINK";
                $tweetId = $response->id_str;
                $text = $response->text;
                $postUrlId = $this->posturl->insert($userId, $stashId, $urlShort, $urlOriginal, $category, $tweetId, $text, 0);
                $this->load->model("activity", '', TRUE);
                $this->activity->insert($userId, $postUrlId, 1);
            }
        }
//        echo "<pre>";
//        print_r($responses);
//        echo "</pre>";
        if (!empty($responses)) {
            if (sizeof($responses) > 0) {
                $sinceIdLast = $responses[0]->id_str;
                $this->configuration->update($sinceIdLast, "TWT_MESSAGE_SINCE_ID");
            }
        }
    }

    public function processTweet() {
        require_once("/home/postuus/public_html/res/lib/Twitter/Extractor.php");
        $this->load->model("posturl", '', TRUE);
        $this->load->model("user", '', TRUE);
        $this->load->model("stash", '', TRUE);
        $this->load->model("configuration", '', TRUE);
        $configuration = $this->configuration->selectByName("TWT_MENTION_SINCE_ID");
        $sinceId = $configuration[0]->VALUE;

        $tokens = array('oauth_token' => "426511615-niNRKMf0Q39nAMt1DZZwg8oBqrb5rby7H58bDdDN", 'oauth_token_secret' => "vYhQUoUVuHrBwXkWQ309HiiKwpopBWbgeWWNBaFXY");
        $this->tweet->set_tokens($tokens);
        if ($sinceId == 0) {
            $responses = $this->tweet->call('get', 'statuses/mentions', array('count' => 10));
        } else {
            $responses = $this->tweet->call('get', 'statuses/mentions', array('since_id' => $sinceId, 'count' => 10));
        }
        for ($i = 0; $i < sizeof($responses); $i++) {
            $response = $responses[$i];
            echo "PROCESSING : " . $response->id_str;
            echo "\n";
            $stashName = NULL;
            $stashId = NULL;
            $tweet = Twitter_Extractor::create($response->text)->extract();
            if (sizeof($tweet['urls']) > 0) {
                $urlTweet = $tweet['urls'][0];
                if (sizeof($tweet['hashtags']) > 0) {
                    $stashName = $tweet['hashtags'][0];
                }
                $userId = $response->user->id_str;
                $username = $response->user->screen_name;
                $name = $response->user->name;
                $password = null;
                $oauthToken = null;
                $oauthTokenSecret = null;
                $profileImageUrl = $response->user->profile_image_url;
                $description = $response->user->description;
                $url = $response->user->url;
                $users = $this->user->selectById($userId);
                if (sizeof($users) == 0) {
                    $this->user->insert($userId, $username, $name, $password, $oauthToken, $oauthTokenSecret, $profileImageUrl, $description, $url);
                }
                if(!is_null($stashName))
                {
                $stashes = $this->stash->selectByUserIdName($userId, $stashName);
                if (sizeof($stashes) == 0) {
                    $stashId = $this->stash->insert($userId, $stashName, null);
                } else {
                    $stashId = $stashes[0]->STASH_ID;
                }
                }
                $urlShort = $urlTweet;
                $urlOriginal = null;
                $category = "LINK";
                $tweetId = $response->id_str;
                $text = $response->text;
                $postUrlId = $this->posturl->insert($userId, $stashId, $urlShort, $urlOriginal, $category, $tweetId, $text, 0);
                $this->load->model("activity", '', TRUE);
                $this->activity->insert($userId, $postUrlId, 1);
            }
        }
//        echo "<pre>";
//        print_r($responses);
//        echo "</pre>";
        if (!empty($responses)) {
            if (sizeof($responses) > 0) {
                $sinceIdLast = $responses[0]->id_str;
                $this->configuration->update($sinceIdLast, "TWT_MENTION_SINCE_ID");
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
