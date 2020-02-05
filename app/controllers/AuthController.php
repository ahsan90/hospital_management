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
        if (LoginHelper::isLoggedIn()){
            //dnd('You already logged in....!!');
            Router::redirect('home');
        }
        $this->view->render('auth/login');
    }

    public function loginPostAction(){
        $username = Input::get('username');
        $password = Input::get('password');


        if (LoginHelper::isValidUser($username, $password)){
            //dnd($_SESSION['password']);
            $msg = "<h2>Login success</h2>";
            $this->view->render('test', $msg);
        }else{
            $msg = "<p class='alert alert-danger'>Invalid Username/Password combination</p>";
            Router::redirect('auth/login', $msg);
            //dnd("Login failed...!");
        }
    }

    //Logout Action
    public function logoutAction(){
        //if not logged in automatically redirect to login page
        if (!LoginHelper::isLoggedIn()){
            Router::redirect('auth/login');
        }
        LoginHelper::logout();
        $msg = "<p class='alert alert-success'>You have been successfully logged out</p>";
        //$this->view->render('home', $msg);
        Router::redirect('home', $msg);
    }
}