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

        return Users::get_users();

    }

    public function get_user($id){

        $verif_id = $this->secure_input($id);

        return Users::get_user($verif_id);
    }

    public function add_user($username, $password, $email, $group){
        $verif_username = $this->secure_input($username);
        $verif_email = $this->secure_input($email);
        $verif_group = $this->secure_input($group);
        Users::post_user($verif_username, $password, $verif_email, $verif_group);
    }

    public function update_user($id,$username, $password, $email, $group){
        $verif_username = $this->secure_input($username);
        $verif_email = $this->secure_input($email);
        $verif_group = $this->secure_input($group);
        Users::update_user($id, $verif_username, $password, $verif_email, $verif_group);
    }

    public function delete_user($id){
        Users::delete_user($id);
    }
}