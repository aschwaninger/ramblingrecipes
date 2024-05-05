<?php
require_once("src/Page.php");
require_once("src/Editor.php");
$builder = new Ramblin\Page();
$builder->buildHeader();
$builder->buildForm();

try {
    $url = "";
    if (!empty($_GET["page"])) {
        $url = $_GET["page"];
    }
    $builder->buildStory($url);
} catch (Exception $e) {
    $builder->showError($e->getMessage());
}

$builder->buildFooter();
