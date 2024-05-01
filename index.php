<?php
require_once("src/Page.php");
$builder = new Ramblin\Page();
$builder->buildHeader();
echo "Let's Get Ramblin'!";
print_r($_GET);

$url = "";
if (!empty($_GET["page"])) {
    $url = $_GET["page"];
}
if (filter_var($url, FILTER_VALIDATE_URL)) {
    echo $url;
    $get = curl_init();

    curl_setopt($get, CURLOPT_URL, $url);
    curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
    
    $page = curl_exec ($get);
    curl_close ($get);
    
    echo $page;
} else {
    echo "url not valid";
}
$builder->buildFooter();
