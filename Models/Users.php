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

    public static function get_users()
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get_user($id)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function post_user($username, $hashed_password, $email, $group)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('INSERT INTO users (username, hashed_password, email, group) VALUES (:username, :hashed_password, :email, :group)');
        $stmt->execute(array(
            ":username" => $username,
            ":password" => $hashed_password,
            ":email" => $email,
            ":group" => $group
        ));
    }

    public static function update_user($username, $password, $email, $group)
    {
    }

    public static function delete_user($id)
    {
    }

}