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
        
    }

    public function beforeRender(){

    }

    protected function redirect($param){

    }
}
