<?php

include_once "../Controllers/ArticlesController.php";
include_once "../Controllers/UsersController.php";

$test1 = new ArticleController();
$test2 = new UsersController();

var_dump($test1->get_article(1));
$test2->add_user("YoMAMA","blabla","yomama@gmail.com","Admin");
$test2->update_user("1","YooooMAMA","blabla","yoooomama@gmail.com","Admin");
$test2->delete_user(2);


//OKLM BB
?>