<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:30
 */
include_once "AppController.php";
include_once "../Models/Article.php";

class ArticleController extends AppController
{
    function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //CRUD FUNCTIONS __________________________________________________________________________________
    // ________________________________________________________________________________________________

    public function get_articles()
    {
        $this->render($articles = Articles::get_articles(), "/layouts/articles.html.twig");
        return Articles::get_articles();
    }

    public function get_article($id)
    {
        $this->render(Articles::get_article($id)[0], "/layouts/article.html.twig");
        return Articles::get_article($id);
    }

    public function add_article($title, $content, $author_id, $category_id)
    {
        $verif_title = $this->secure_input($title);
        $verif_content = $this->secure_input($content);
        Articles::post_article($verif_title, $verif_content, $author_id, $category_id);
        return true;
    }
    

    //RENDER FUNCTIONS ________________________________________________________________________________
    // ________________________________________________________________________________________________

    public function render_add_article($datas = [])
    {
            $this->render($datas, "/form/add_article.html.twig");
            return true;
    }

    public function render_display_articles($datas = [])
    {
        $this->render($datas, "/layouts/articles.html.twig");
        return true;
    }

    //ADD USERS FUNCTION ______________________________________________________________________________
    // ________________________________________________________________________________________________

    public function add_article_datas ()
    {
        $feedback = [];
        $flag = false;
        if (isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["author_id"]) && isset($_POST["category_id"]))
        {
            $feedback = ["input_title" => $_POST["title"], "input_content" => $_POST["content"], "input_author_id" => $_POST["author_id"], "input_category_id" => $_POST["category_id"]];

            $flag = true;
            if (strlen($_POST["title"]) < 3)
            {
                $flag = false;
                $error_title = [ "error_title" => "title to short !"];
                $feedback = array_merge($feedback, $error_title);
            }
            if (strlen($_POST["content"]) < 3)
            {
                $flag = false;
                $error_content = [ "error_content" => "content to short !"];
                $feedback = array_merge($feedback, $error_content);
            }

            //SEND WITH SECURE_INPUTS
            if ($flag == true){
                $this->add_article($this->secure_input($_POST["title"]), $this->secure_input($_POST["content"]), $_POST["author_id"], $_POST["category_id"]);
                $feedback = ["succes" => "ALL GOOD BRO."];
            }
        }
        $this->render_add_article($feedback);
        return true;
    }
}