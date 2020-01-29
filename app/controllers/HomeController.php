<?php


class HomeController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction(){
        //die('Welcome from home controller of index action');
        $this->view->render('home/index');
    }
}