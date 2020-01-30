<?php


class NurseController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function profileAction($id){
        $this->view->render('nurse/profile', Nurse::all()->find($id));
    }
    public function listingAction(){
        $this->view->render('nurse/list', Nurse::all());
    }
}