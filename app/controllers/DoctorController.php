<?php


class DoctorController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function profileAction($id){
        $this->view->render('doctor/profile', Doctor::all()->find($id));
    }
    public function listingAction(){
        $this->view->render('doctor/list', Doctor::all());
    }

	public function editAction($id){
        $this->view->render('doctor/edit', Doctor::all()->find($id));
    }
}