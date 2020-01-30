<?php


class PatientController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function registerAction(){
        $patient = new Patient();
        $this->view->render('patient/register', $patient);
    }

    public function registerPostAction(){
        if ($_POST){
            $msg = Input::get('dob');
        }else{
            $msg = "Not poster";
        }

        $this->view->render('test', $msg);
    }

    public function profileAction($id){
        $this->view->render('patient/profile', Patient::all()->find($id));
    }
    public function listingAction(){
        $this->view->render('patient/list', Patient::all());
    }
}