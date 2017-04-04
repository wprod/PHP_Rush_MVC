<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:29
 */
include_once "../Config/db.php";

class Articles
{

    public static function get_articles()
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM articles');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function get_article($id)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM articles WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function post_article($title, $description = null)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('INSERT INTO articles (title, description) VALUES (:title, :description)');
        $stmt->execute(array(
                ':title' => $title,
                ':description' => $description
            )
        );
    }

    public static function put_article($id, $title = null, $description = null)
    {

    }

    public static function delete_article($id)
    {

    }

}