<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:29
 */
include_once "../Config/db.php";

class Users
{
    //GET USERS _______________________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function get_users()
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //GET USER ________________________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function get_user($id)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //GET USER  BY EMAIL ______________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function get_user_email($email)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //CREATE USER _____________________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function post_user($username, $hashed_password, $email)
    {
        $obj = dbConn::getConnection();

        $stmt = $obj->prepare('INSERT INTO users (username, hashed_password, email) VALUES (:username, :hashed_password, :email)');
        return $stmt->execute(
            array(
                ":username" => $username,
                ":hashed_password" => $hashed_password,
                ":email" => $email,
                )
        );
    }

    //UPDATE USER _____________________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function update_user($id, $username, $email, $hashed_password, $groupe)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare("
                UPDATE users
                SET email = :email, username = :username, hashed_password = :hashed_password, groupe = :groupe
                WHERE id = :id ");
        return $stmt->execute(array(
            ":id" => $id,
            ":username" => $username,
            ":email" => $email,
            ":hashed_password" => $hashed_password,
            ":groupe" => $groupe
        ));
    }

    //DELETE USER BY ID _______________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function delete_user($id)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare("DELETE FROM users WHERE id = :id ");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

}