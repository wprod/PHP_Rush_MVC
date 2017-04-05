<?php

include_once "../Config/core.php";

$test2 = new UsersController();

$test2->add_user("YoMAMA","blabla","yomama@gmail.com","Admin");
$test2->update_user("1","YooooMAMA","blabla","yoooomama@gmail.com","Admin");
$test2->delete_user(2);

var_dump($test2->get_user(8));


$router = new Router($_GET['url']);
$router->get('/', function(){ echo "Homepage"; });
$router->get('/posts', function(){ echo 'Tous les articles'; });
$router->get('/article/:slug-:id/:page', "Posts#show")->with('id', '[0-9]+')->with('page', '[0-9]+')->with('slug', '([a-z\-0-9]+)');
$router->get('/article/:slug-:id', "Posts#show")->with('id', '[0-9]+')->with('slug', '([a-z\-0-9]+)');

$router->run();


?>