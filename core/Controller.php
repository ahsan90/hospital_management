<?php


class Controller extends Application
{
    protected $_controller, $_action;
    public $view;

    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->_controller = $controller;
        $this->_action = $action;
        $this->view = new View();
    }

    public function jsonResponse($response){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset:UTF-8");
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

//    protected function load_model($model){
//        if (class_exists($model)){
//            $this->{$model.'Model'} = new $model(strtolower($model));
//        }
//    }
}