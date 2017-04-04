<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:30
 */
include_once "AppController.php";
include_once "../Models/Article.php";

class ArticleController extends AppController {

    function secure_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function  get_articles(){

        $tasks = Articles::get_articles();

        foreach($tasks as $key => $task)
        {
            $tasks[$key]['title'] = htmlspecialchars($task['title']);
            $tasks[$key]['description'] = nl2br(htmlspecialchars($task['description']));
        }

        return $tasks;
    }

    public function get_article($id){

        $verif_id = $this->secure_input($id);

        return Articles::get_article($verif_id);
    }

    public function post_article($title, $description){
        $verif_title = $this->secure_input($title);
        $verif_description = $this->secure_input($description);

        Articles::post_article($verif_title,$verif_description);
    }
}