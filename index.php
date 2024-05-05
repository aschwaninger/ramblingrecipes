<?php
require_once("src/Page.php");
$builder = new Ramblin\Page();
$builder->buildHeader();
$builder->buildForm();

$url = "";
if (!empty($_GET["page"])) {
    $url = $_GET["page"];
}
if (filter_var($url, FILTER_VALIDATE_URL)) {
    $builder->buildStory($url);
} else {
    echo "url not valid";
}
$builder->buildFooter();
