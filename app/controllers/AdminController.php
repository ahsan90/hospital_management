<?php


class AdminController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    //Get the admin home page
    public function indexAction(){
        $this->restrictUnauthorizedUser();
        $this->view->render('admin/index');
    }

    //List all users
    public function userListAction(){
        $this->restrictUnauthorizedUser();
        $this->view->render('admin/user', User::all());
    }

    //Restrict unauthorized user to access admin panel
    public function restrictUnauthorizedUser(){
        if (!LoginHelper::isAdmin()){
            $msg = "<p class='alert alert-danger'>You are not authorized</p>";
            Router::redirect('home',$msg);
        }
    }

}