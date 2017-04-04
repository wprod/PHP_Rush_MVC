<?php

include_once "../Controllers/ArticlesController.php";
include_once "../Controllers/UsersController.php";

$test1 = new ArticleController();
$test2 = new UsersController();

var_dump($test1->get_article(1));
$test2->add_user("YoMAMA","blabla","yomama@gmail.com","Admin");

?>