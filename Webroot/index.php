<?php

include_once "../Config/core.php";

$test2 = new UsersController();

$test2->add_user("YoMAMA","blabla","yomama@gmail.com","Admin");
$test2->update_user("1","YooooMAMA","blabla","yoooomama@gmail.com","Admin");
$test2->delete_user(2);


//OKLM BB
?>