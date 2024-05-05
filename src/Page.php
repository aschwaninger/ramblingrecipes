<?php

namespace Ramblin;

class Page {
    private $jsDir = "/theme/";
    private $cssDir = "/theme/";
    private $viewsDir = "views/";

    public function buildHeader() {
        include_once($this->viewsDir."header.php");;
    }

    public function buildFooter() {
        include_once($this->viewsDir."footer.php");
    }

    public function buildForm() {
        include_once($this->viewsDir."recipe_form.php");
    }

    public function buildStory($url) {
        $get = curl_init();

        curl_setopt($get, CURLOPT_URL, $url);
        curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
        
        $page = curl_exec ($get);
        curl_close ($get);
    }
}