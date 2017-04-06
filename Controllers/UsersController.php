<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:30
 */
include_once "AppController.php";
include_once "../Models/Users.php";

class UsersController extends AppController
{

    function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function get_users()
    {
        $this->render($users = Users::get_users(), "/layouts/users.html.twig");
        return Users::get_users();
    }

    public function get_user($id)
    {
        $this->render(Users::get_user($id)[0], "/layouts/user.html.twig");
        return Users::get_user($id);
    }

    public function add_user($username, $password, $email, $group)
    {
        $verif_username = $this->secure_input($username);
        $verif_email = $this->secure_input($email);
        $verif_group = $this->secure_input($group);
        Users::post_user($verif_username, $password, $verif_email, $verif_group);
    }

    public function render_add_user(){
 
        return $this->render([], "/form/add_user.html.twig");
    }

    public function update_user($id, $username, $password, $email, $group)
    {
        $verif_username = $this->secure_input($username);
        $verif_email = $this->secure_input($email);
        $verif_group = $this->secure_input($group);
        Users::update_user($id, $verif_username, $password, $verif_email, $verif_group);
    }

    public function delete_user($id)
    {
        Users::delete_user($id);
    }
}