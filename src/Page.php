<?php

namespace Ramblin;

class Page {
    private $jsDir = "/theme";
    private $cssDir = "/theme";

    public function buildHeader() {
        echo '' ?>
<html>
    <head>
        <title>Rambling Recipes</title>
    </head>
    <body>
<?php ;
    }

    public function buildFooter() {
        echo '' ?>
    </body>
</html>
<?php ;
    }
}