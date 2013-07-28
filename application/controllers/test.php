<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index() {
/*
        require_once('/var/www/postlink/res/lib/simple_html_dom.php');
        $html = new Simple_html_dom();

        $html->load_file('http://premiumoodshoes.tumblr.com/');
        foreach ($html->find('img') as $element)
            echo "<img width=100 src=\"" . $element->src . "\"/>" . $element->src . '<br>';
*/
        $url="http://google.com/springpad/images/elements/logo.springpad.300w.png";
        $urlList = parse_url($url);
        echo "<pre>";
        print_r($urlList);
        echo "</pre>";
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */