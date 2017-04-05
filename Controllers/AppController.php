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

    public function render($file = null){
        require_once '../vendor/autoload.php';
        $loader = new Twig_Loader_Filesystem('Views\Layouts\users.twig');
        $twig = new Twig_Environment($loader, array(
            'cache' => '/path/to/compilation_cache',
        ));
        $template = $twig->load('../Views/Layouts/users.twig');
        echo $template->render(array('the' => 'variables', 'go' => 'here'));
        echo "lol";
    }

    public function beforeRender(){

    }

    protected function redirect($param){

    }
}
