<?php
/*
 * Author: Md Ahsanul Hoque
 * Date: February 5, 2020
 * Purpose: Control the admin page and administrative task
 *
 */

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

    public function editAction($id){
        $this->restrictUnauthorizedUser();
        $this->view->render('admin/edit', User::all()->find($id));
    }

    public function editpostAction($id){
        $this->restrictUnauthorizedUser();

        $username = Input::get('username');
        $password = Input::get('password');
        //dnd($username);
        if (Validation::isEmpty($username) || Validation::isEmpty($password)){
            Router::redirect('admin/edit/'.$id, '<p class="alert alert-danger">Please enter proper login credentials</p>');
        }
        $user = User::all()->find($id);
        $user->username = $username;
        $user->password = md5($password);
        $user->save();
        Router::redirect('admin', '<p class="alert alert-success">Information save successfully...!</p>');
    }
    //List all users
    public function userListAction(){
        $this->restrictUnauthorizedUser();
        $this->view->render('admin/user', User::all()->sortBy('role_id'));
    }

    //Restrict unauthorized user to access admin panel
    public function restrictUnauthorizedUser(){
        if (!LoginHelper::isAdmin()){
            $msg = "<p class='alert alert-danger'>You are not authorized</p>";
            Router::redirect('home',$msg);
        }
    }

}