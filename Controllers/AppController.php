<?php

/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 11:27
 */
class AppController
{

    protected $model;

    public function loadModel($model)
    {
        $this->$model = dbConn::getConnection();
    }

    //CORE RENDER _____________________________________________________________________________________
    // ________________________________________________________________________________________________

    public function render($file = null, $template)
    {
        require_once '../vendor/autoload.php';
        $loader = new Twig_Loader_Filesystem('../Views/');
        $twig = new Twig_Environment($loader, array(
            'cache' => false,
            'debug' => true
        ));
        $twig->addExtension(new Twig_Extension_Debug());
        echo $twig->render($template, $file);
    }

    //REDIRECT ________________________________________________________________________________________
    // ________________________________________________________________________________________________

    protected function redirect($param)
    {
        header('Location: '.$param);
        die();
    }
}
