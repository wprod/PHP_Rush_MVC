<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 09:33
 */

//SESSION START ___________________________________________________________________________________
// ________________________________________________________________________________________________

session_start();

//AUTOLOAD ________________________________________________________________________________________
// ________________________________________________________________________________________________

function autoload_class_multiple_directory($class_name)
{
    # List all the class directories in the array.
    $array_paths = array(
        '../Controllers/',
        '../Models/',
        '../Src/'
    );
    # Count the total item in the array.
    $total_paths = count($array_paths);
    # Set the class file name.
    $file_name = $class_name.'.php';
    # Loop the array.
    for ($i = 0; $i < $total_paths; $i++)
    {
        if(file_exists($array_paths[$i].$file_name))
        {
            include_once $array_paths[$i].$file_name;
        }
    }
}
spl_autoload_register('autoload_class_multiple_directory');


//DISPATCHER ______________________________________________________________________________________
// ________________________________________________________________________________________________

$router = new Router(isset($_GET['url']) ? $_GET['url'] : "/");

$router->get('/', "Users#render_home");

$router->get('/users', "Users#get_users");
$router->get('/user_:id', "Users#get_user")->with('id', '[0-9]+');

$router->get('/add_user', "Users#render_add_user");
$router->post('/add_user', "Users#add_user_datas");

$router->get('/log_in', "Users#render_log_in");
$router->post('/log_in', "Users#log_in");

$router->get('/log_out', "Users#render_log_out");

$router->get('/articles', "Article#get_articles");
$router->get('/article_:id', "Article#get_article")->with('id', '[0-9]+');

$router->get('/add_article', "Article#render_add_article");
$router->post('/add_article', "Article#add_article_datas");

$router->run();


