<?php


class AuthController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function createUserAction(){
        $this->view->render('auth/register');
    }

    public function loginAction(){
        $this->view->render('auth/login');
    }
}