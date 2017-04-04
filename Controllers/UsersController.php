<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:30
 */
include_once "AppController.php";
include_once "../Models/Users.php";

class UsersController extends AppController {

    function secure_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function  get_users(){

        $tasks = Users::get_users();

        foreach($tasks as $key => $task)
        {
            $tasks[$key]['title'] = htmlspecialchars($task['title']);
            $tasks[$key]['description'] = nl2br(htmlspecialchars($task['description']));
        }

        return $tasks;
    }

    public function get_user($id){

        $verif_id = $this->secure_input($id);

        return Users::get_user($verif_id);
    }

    public function add_user($username, $password, $email, $group){
        $verif_username = $this->secure_input($username);
        $verif_email = $this->secure_input($email);
        $verif_group = $this->secure_input($group);

        //TODO PASSWORD

        Users::post_user($verif_username, $password, $verif_email, $verif_group);
    }
}