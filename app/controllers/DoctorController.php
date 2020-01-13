<?php


class DoctorController extends BaseController
{
    public function list()
    {
        $doctors = Doctor::all();
        $this->render('doctor/list', $doctors);
    }
    public function profile(){
        $this->render('doctor/profile');
    }

    public function edit($id){
        $this->render('doctor/edit', null);
    }

}