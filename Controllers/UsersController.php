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

    //CRUD FUNCTIONS ______________________________________________________

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
    
    public function get_user_email($email)
    {
        return Users::get_user_email($email);
    }

    public function add_user($username, $password, $email, $group)
    {
        $verif_username = $this->secure_input($username);
        $verif_email = $this->secure_input($email);
        $verif_group = $this->secure_input($group);
        Users::post_user($verif_username, $password, $verif_email, $verif_group);
        return true;
    }

    public function update_user($id, $username, $password, $email, $group)
    {
        $verif_username = $this->secure_input($username);
        $verif_email = $this->secure_input($email);
        $verif_group = $this->secure_input($group);
        Users::update_user($id, $verif_username, $password, $verif_email, $verif_group);
        return true;
    }

    public function delete_user($id)
    {
        Users::delete_user($id);
        return true;
    }

    //RENDER FUNCTIONS ______________________________________________________

    public function render_add_user()
    {
        $this->render([], "/form/add_user.html.twig");
        return true;
    }

    public function render_home ()
    {
        //TODOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO____________________________________________________
        //FAIRE LA GESTION DE SESSION
        $this->render([], "/layouts/index.html.twig");
        return true;
    }

    public function render_log_in()
    {
        $this->render([], "/form/log_in.html.twig");
        return true;
    }

   //ADD USERS FUNCTION ______________________________________________________

    public function add_user_datas ()
    {
        $feedback = [];
        $flag = false;
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["group"]))
        {
            $feedback = ["input_username" => $_POST["username"], "input_password" => $_POST["password"], "input_email" => $_POST["email"], "input_group" => $_POST["group"]];

            $flag = true;
            if (strlen($_POST["username"]) < 3)
            {
                $flag = false;
                $error_username = [ "error_username" => "Username to short !"];
                $feedback = array_merge($feedback, $error_username);
            }
            if (strlen($_POST["password"]) < 3)
            {
                $flag = false;
                $error_password = [ "error_password" => "Password to short !"];
                $feedback = array_merge($feedback, $error_password);
            }
            if (strlen($_POST["email"]) < 3)
            {
                $flag = false;
                $error_email = [ "error_email" => "Email to short !"];
                $feedback = array_merge($feedback, $error_email);
            }
            if ($_POST["group"] != "admin" && $_POST["group"] != "user")
            {
                $flag = false;
                $error_group = [ "error_group" => "Group not yet defined ! use 'admin' or 'user'."];
                $feedback = array_merge($feedback, $error_group);
            }

            //SEND WITH SECURE_INPUTS
            if ($flag == true){
                $this->add_user($this->secure_input($_POST["username"]), $this->secure_input($_POST["password"]), $this->secure_input($_POST["email"]), $this->secure_input($_POST["group"]));
                $feedback = ["succes" => "ALL GOOD BRO."];
            }
        }
        $this->render($feedback, "/form/add_user.html.twig");
        return true;
    }

    // LOG IN FUNCTION ______________________________________________________

    public function log_in()
    {
        $feedback = [];
        $flag = false;
        if (isset($_POST["password"]) && isset($_POST["email"]))
        {
            $feedback = ["input_password" => $_POST["password"], "input_email" => $_POST["email"]];

            $flag = true;
            $password = "";
            if (strlen($_POST["email"]) < 3)
            {
                $flag = false;
                $error_email = [ "error_email" => "Email to short !"];
                $feedback = array_merge($feedback, $error_email);
            }
            else
            {
                if (Users::get_user_email($_POST["email"]) != null)
                {
                    $password = Users::get_user_email($_POST["email"]);
                    $password = $password[0]["hashed_password"];
                }
                else
                {
                    $error_email = [ "error_email" => "Your email isn't in our database, sorry !"];
                    $feedback = array_merge($feedback, $error_email);
                }
            }

            if (strlen($_POST["password"]) < 3)
            {
                $flag = false;
                $error_password = [ "error_password" => "Password to short !"];
                $feedback = array_merge($feedback, $error_password);
            }
            else if ($_POST["password"] == $password)
            {
                Session::set($_POST["email"], "logged");
            }
            else
            {
                $flag = false;
                $error_password = [ "error_password" => "Password isn't correct !"];
                $feedback = array_merge($feedback, $error_password);
            }

            if ($flag == true)
            {
                $feedback = ["succes" => "YOU'RE LOGGED IN BRO."];
            }
        }

        $this->render($feedback, "/form/log_in.html.twig");
        return true;
    }


}