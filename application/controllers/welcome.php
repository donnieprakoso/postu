<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
        $this->load->model("posturl", '', TRUE);
        $this->load->model("user", '', TRUE);
        $this->load->model("user_featured", '', TRUE);
        $featuredUsers = $this->user->selectAllFeatured();
        for ($i = 0; $i < sizeof($featuredUsers); $i++) {
            $postsFeaturedUser = $this->posturl->selectByUserIdLimit($featuredUsers[$i]->USER_ID, 5);
            $featuredUsers[$i]->LINKS = $postsFeaturedUser;
        }
        $data['featuredUsers'] = $featuredUsers;
        $this->load->view("template/head");

        $this->load->view('welcome_message', $data);
    }

    public function login() {

        $this->load->view("template/head");
        $this->load->view("login");
    }

    public function signup() {

        $this->load->view("template/head");
        $this->load->view("signup");
    }

    public function faq() {
        $this->load->helper('url');

        $this->load->view("template/head");
        $this->load->view("faq");
    }

    public function logout() {
        $this->tweet->logout();
        $this->session->sess_destroy();
        redirect("welcome");
    }

    public function about() {
        $this->load->view("template/head");
        $this->load->view('about');
    }

    public function register() {
        $this->load->view("template/head");
        $this->load->view('register');
    }

    public function registerNow() {
        $this->load->model("user", '', TRUE);
        $user = $this->session->userdata("twitterUser");
        $token = $this->session->userdata("twitter_oauth_tokens");
        $password = $this->input->post("password");
        $confirmPassword = $this->input->post("confirm-password");

        if ($password != $confirmPassword) {
            redirect("welcome/signup/");
        }
        if (sizeof($user) == 0) {
            redirect("welcome/signup/");
        }
        if (sizeof($token) == 0) {
            redirect("welcome/signup/");
        }

        $this->user->insert($user['id'], $user['screen_name'], $user['name'], $password, $token['access_key'], $token['access_secret'], $user['image_url'], $user['description'], $user['url']);
        $users = $this->user->selectByIdPassword($user['id'], $password);
        $user = $users[0];
        $this->session->set_userdata("user", $user);
        $this->session->unset_userdata("twitterUser");
        $this->session->unset_userdata("twitter_oauth_tokens");
        redirect("welcome/home");
    }

    public function home() {

        $user = $this->session->userdata("user");
        $this->load->model("activity", '', TRUE);
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);
        if ($user != null) {
            if (sizeof($user) > 0) {
                $links = $this->posturl->selectOrderByDate($user->USER_ID);
                $stashes = $this->stash->selectByUserId($user->USER_ID);
                $data['stashes'] = $stashes;
                $data['user'] = $user;
                $timeline = $this->activity->selectAll($user->USER_ID, 1, 30);
                $data['timeline'] = $timeline;
                $data['links'] = $links;
                $this->load->view("template/head");
                $this->load->view("template/header");
                $this->load->view("template/stashLink", $data);

                $this->load->view("home", $data);
            }
        }
    }

    public function bookmarklet() {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $data['stashes'] = $stashes;
        $this->load->library('encrypt');
        $message = $user->USER_ID . "&" . $user->PASSWORD;
        $key = 'insane-postLink';
        $encrypted_string = $this->encrypt->encode($message, $key);
        $stringEncrypt = str_replace("+", "!@!", $encrypted_string);
        $url = urlencode(site_url("ipostit/postMaster/?m=") . $stringEncrypt);

//                $javascript = "javascript:(function(){javascript:window.open(\"" . $url . "/\"+escape(document.location.href),\"IPostIt!\",\"width=400,height=400,location=no,toolbar=no,status=no,menubar=no,hotkeys=no,directories=no,resizable=yes,scrollbars=yes,screenX=\"+(screen.availWidth/3)+\",screenY=\"+0);})();";
//                $javascript = "javascript:(function()
//                    {
//                        javascript:window.open(\"" . $url . "&url=\"+encodeURIComponent(document.location.href)+\"&title=\"+document.title,\"IPostIt!\",\"width=960,height=800,location=no,toolbar=no,status=no,menubar=no,hotkeys=no,directories=no,resizable=yes,scrollbars=yes,screenX=\"+(screen.availWidth/3)+\",screenY=\"+0);
//                            })();";
        $javascript = "javascript:void((function()
       {
       var postLinkUrl = '$url';
       var url = encodeURIComponent(document.location.href);
       var title = encodeURIComponent(document.title);
       var options  = 'width=500,height=500,location=no,toolbar=no,status=no,menubar=no,hotkeys=no,directories=no,resizable=yes,scrollbars=yes';
       var imagesEl='';
       var images=document.getElementsByTagName('img');
       for(i=0;i<images.length;i++)
       {
       if(images[i].width>100)
       {
       imagesEl += '&img='+encodeURIComponent(images[i].src);
       }        
       }
       window.open(postLinkUrl+'&url='+url+'&title='+title+imagesEl, 'Post It', options);

       })());";
        $data['bookmarklet'] = $javascript;
        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("bookmarklet", $data);
    }

    public function unstashed() {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);
        $linksCount = $this->posturl->selectCountByUserIdNotDefined($user->USER_ID);
        $data['stats']['links'] = $linksCount[0]->TOTAL_LINK;
        $links = $this->posturl->selectByUserIdNotDefined($user->USER_ID);
        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $data['stashes'] = $stashes;
        $data['links'] = $links;
        $data['user'] = $user;

        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("unstashed", $data);
    }

    public function stash($stashId) {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);

        $links = $this->posturl->selectByUserIdStashId($user->USER_ID, $stashId);
        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $stashObj = $this->stash->selectByUserIdAndStashId($user->USER_ID, $stashId);
        $linksCount = $this->posturl->selectCountLinkByUserIdAndStashId($user->USER_ID, $stashId);
        $data['stats']['links'] = $linksCount[0]->TOTAL_LINK;
        $data['stashes'] = $stashes;
        $data['links'] = $links;
        $data['user'] = $user;
        $data['stashObj'] = $stashObj[0];
        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("stash", $data);
    }

    public function stashList() {
        $user = $this->session->userdata("user");
        $this->load->model("stash", '', TRUE);
        $this->load->model("posturl", '', TRUE);


        $stashes = $this->stash->selectByUserId($user->USER_ID);
        $stashesCount = $this->stash->selectCountStashByUserId($user->USER_ID);
        $data['stats']['stashes'] = $stashesCount[0]->TOTAL_STASH;
        $data['stashes'] = $stashes;

        $data['user'] = $user;

        $this->load->view("template/head");
        $this->load->view("template/header");
        $this->load->view("template/stashLink", $data);
        $this->load->view("stashList", $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
