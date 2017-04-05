<?php
/**
 * Created by PhpStorm.
 * User: Amand
 * Date: 04/04/2017
 * Time: 11:27
 */

class AppController {

    protected $model;

    public function loadModel($model){
        $this->$model = dbConn::getConnection();
    }

    public function render($file = null, $template){
        require_once '../vendor/autoload.php';
        $loader = new Twig_Loader_Filesystem('../Views/Layouts/');
        $twig = new Twig_Environment($loader, array(
            'cache' => '/path/to/compilation_cache',
            'debug' => 'true'
        ));
        var_dump($file);
        echo $twig->render($template, $file);
    }

    public function beforeRender(){

    }

    protected function redirect($param){

    }
}
