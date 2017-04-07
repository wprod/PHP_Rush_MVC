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
    //GET ARTICLES ____________________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function get_articles()
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM articles');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //GET ARTICLE _____________________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function get_article($id)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare('SELECT * FROM articles WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //CREATE ARTICLE __________________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function post_article($title, $content, $author_id, $category_id)
    {
        $obj = dbConn::getConnection();

        $stmt = $obj->prepare('INSERT INTO articles (title, content, author_id, category_id) VALUES (:title, :content, :author_id, :category_id)');
        return $stmt->execute(
            array(
                ":title" => $title,
                ":content" => $content,
                ":author_id" => $author_id,
                ":category_id" => $category_id,
            )
        );
    }

    //DELETE ARTICLE BY ID _______________________________________________________________________________
    // ________________________________________________________________________________________________

    public static function delete_article($id)
    {
        $obj = dbConn::getConnection();
        $stmt = $obj->prepare("DELETE FROM articles WHERE id = :id ");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

}