<?php


use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    //Search doctor and available schedule for fixing an appointment date

    public function searchAction(){
        //dnd(Input::get('healthCardNo'));

//        if(LoginHelper::isAdmin()){
//            $msg = "<p class='alert alert-warning'>you are not authorized..............</p>";
//            Router::redirect('home', $msg);
//        }
        //dnd(LoginHelper::isACurrentDoctor());
        //Make sure doctor is not allowed to book appointment
        //dnd($this->checkIfScheduleAvail(1, "9.00", '2020-02-07'));

        if (LoginHelper::isACurrentDoctor()){
            Router::redirect('home', "<p class='alert alert-danger'>Unauthorized</p>");
        }
        $selectedDoctorSpecializations = array();
        $doctors = Doctor::all();

        foreach ($doctors as $current){
            if (!in_array($current->specialization, $selectedDoctorSpecializations)){
                $selectedDoctorSpecializations[] = $current->specialization;
            }
        }

        $_SESSION['doctors_specialization'] = $selectedDoctorSpecializations;

        $this->view->render('appointment/search');
    }

    public function bookingAction(){

        //dnd(Input::get('healthCardNo'));

        if (LoginHelper::isACurrentDoctor()){
            Router::redirect('home', "<p class='alert alert-danger'>Unauthorized</p>");
        }
        if ($_POST){

            $specialization = Input::get('specialization');

            $datePicked = Input::get('date');
            //dnd($datePicked);

            //Check validation for appointment date
            if (Validation::isEmpty($datePicked)){
                Router::redirect('appointment/search', '<p class="alert alert-danger">Please enter date</p>');
            }


            //redirect search page if the user enter past/invalid date
            if (!Validation::isValidBookingDate($datePicked)){
                Router::redirect('appointment/search', '<p class="alert alert-danger">Appointment date cannot be past date</p>');
            }

            $doctorsOnSpecialization = Doctor::all()->where('specialization', $specialization);
            //dnd($datePicked);
            if (LoginHelper::isAdmin() || LoginHelper::isACurrentNurse()){
                $healthCardNumber = Input::get('healthCardNo');
                if (Validation::isEmpty($healthCardNumber)){
                    Router::redirect('appointment/search', '<p class="alert alert-danger">Health Card number cannot be empty</p>');
                }
                if (!Validation::isHealthCardExists($healthCardNumber)){
                    //dnd($healthCardNumber);
                    //dnd(Validation::isHealthCardExists($healthCardNumber));
                    Router::redirect('appointment/search', '<p class="alert alert-danger">Health Card Number is not found in the system</p>');
                }
                $_SESSION['healthCardNo'] = $healthCardNumber;
            }


            $_SESSION['doctors'] = $doctorsOnSpecialization;
            //dnd($selectedDoctorsId);
            $_SESSION['datePicked'] = $datePicked;

            $this->view->render('appointment/book');
        }
        else{
            Router::redirect('appointment/search',"<p class='alert alert-danger'>Select Doctor type and possible booking date</p>");
        }
    }

    public function bookingPostAction(){
        if (LoginHelper::isACurrentDoctor()){
            Router::redirect('home', "<p class='alert alert-danger'>Unauthorized</p>");
        }
        if ($_POST){
            $slot = Input::get('slot');
            $datePicked = Input::get('datePicked');
            $doctor_id = Input::get('doctorId');
            //$docotor = Doctor::all()->find()
            //$currentUser = LoginHelper::getCurrentUser();
            //dnd($datePicked);
            $appointment = new Appointment();

            //$schedule_id = Schedule::all()->find($slot)->id;

            if (LoginHelper::isACurrentNurse() || LoginHelper::isAdmin()){
                $heathCardNumber = $_SESSION['healthCardNo'];
                unset($_SESSION['healthCardNo']);
                $patient = UserHelper::getPatientBasedOnHealthCardNo($heathCardNumber);
            }else{
                $patient = UserHelper::getCurrentLoggedInPatient();
            }

            $appointment->saveAppointment($patient->id, $doctor_id, $slot, $datePicked);
            $appointments = Appointment::all();

            $_SESSION['doctor'] = Doctor::all()->find($doctor_id);
            $_SESSION['slot'] = $slot;


            foreach ($appointments as $current){
                if ($current->time == $slot && $current->date == $datePicked){
                    $appointment = $current;
                    break;
                }
            }
            $this->view->render('appointment/bookingDetails', $appointment);
        }
        else{
            Router::redirect('home', '<p class="alert alert-danger">Unauthorized</p>');
        }
    }

    //Ajax calling Action for pulling out available schedule
    public function bookingAjaxAction(){
        //
        if (LoginHelper::isACurrentDoctor()){
            Router::redirect('home', "<p class='alert alert-danger'>Unauthorized</p>");
        }
        //$slot = Input::get('slot');
        $datePicked = Input::get('datePicked');
        $doctor_id = Input::get('doctor_id');
        //$datep = Input::get('datep');

        $selectedSchedules = array();

        $schedules = Schedule::all();

        //dnd($this->checkIfScheduleAvail(1, "9.00", '2020-02-07'));
        //Stole available schedule to selectedSchedule variable
        foreach ($schedules as $schedule){
            if (!$this->isTheTimeBooked($doctor_id, $schedule->time, $datePicked)){
                $selectedSchedules[] = $schedule->time;
            }
        }

        //$response = ['success' => true, 'data' => ["checkSchedule"=>$this->isTheTimeBooked($doctor_id, '9.00', $datePicked)]];
        $response = ['success' => true, 'data' => ["selectedSchedules"=>$selectedSchedules, "doctor_id" => $doctor_id]];
        //$response = ['success' => true, 'data' => ["selectedSchedules"=>$selectedSchedules, "datep" => $datep]];
        $this->jsonResponse($response);//Send back as json response

        //dnd($selectedSchedules);

        //dnd($schedudes->find(2)->time);
    }

    //Delete an Appointment
    public function deleteAction($id){
        if (LoginHelper::isACurrentPatient() || LoginHelper::isAdmin()){
            //A patient is only allowed to delete his/her own appointment
            $appointment = Appointment::all()->find($id);
            if ($appointment->patient_id == UserHelper::getCurrentLoggedInPatient()->id || LoginHelper::isAdmin()){
                $appointment->delete();
                if (LoginHelper::isACurrentPatient()) Router::redirect('patient/profile/'.UserHelper::getCurrentLoggedInPatient()->id, '<p class="alert alert-success">Appointment deleted...!!</p>');
                if (LoginHelper::isAdmin()) Router::redirect('admin/index', '<p class="alert alert-success">Appointment deleted</p>');
            }else{
                Router::redirect('home/index', '<p class="alert alert-success">Unauthorized</p>');
            }
            //dnd($id);
        }
        else{
            Router::redirect('home/index', '<p class="alert alert-success">Unauthorized</p>');
        }
    }

    //Check if the schedule is available
    private function isTheTimeBooked($doctor_id, $time, $date){
        $flag = false;
        $appointments = Appointment::all();
        foreach ($appointments as $appointment){
            if ($appointment->date == $date && $appointment->doctor_id == $doctor_id && $appointment->time == $time){
                return true;
            }
        }
        return $flag;
    }
}