<?php


class AdminController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction(){
        $this->view->render('admin/index');
    }

    public function userListAction(){
        $this->view->render('admin/user', User::all());
    }

}