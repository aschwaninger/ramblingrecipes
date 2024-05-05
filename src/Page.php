<?php

namespace Ramblin;

class Page {
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
        $story = new Editor($url);
        include($this->viewsDir."container.php");
    }

    public function showError($msg) {
        echo '<div class="exception">'.$msg.'</div>';
    }
}