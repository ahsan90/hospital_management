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
        if ($_POST){
            $specialization = Input::get('specialization');
            $datePicked = Input::get('date');
            $doctorsOnSpecialization = Doctor::all()->where('specialization', $specialization);
            //dnd($specialization);


            $_SESSION['doctors'] = $doctorsOnSpecialization;
            //dnd($selectedDoctorsId);



            //$doctor_id = Input::get('1');
//            foreach ($_SESSION['doctors'] as $doctor){
//
//            }
            //dnd($_SESSION['doctors']);

            $_SESSION['datePicked'] = $datePicked;
//
//
//            $selectedSchedules = array();
//
//            $schedule = Appointment::all()->where('date', $datePicked)->first();
//
//            if ($schedule){
//
//                foreach (Schedule::all() as $current){
//
//                    if ($current->id != $schedule->schedule_id && $schedule->doctor_id != $doctor_id){
//                        array_push($selectedSchedules, $current);
//                    }elseif ($current->id == $schedule->schedule_id && $schedule->doctor_id != $doctor_id){
//                        if ($this->checkScheduleIsDifferent($current->time, $current->id))
//                        array_push($selectedSchedules, $current);
//                    }
//                }
//                $_SESSION['slots'] = $selectedSchedules;
//            }
//            else{
//                $_SESSION['slots'] = Schedule::all();
//                //dnd('not found');
//            }

        }

        $this->view->render('appointment/book');
    }

    public function bookingAjaxAction(){
        //$slot = Input::get('slot');
        $datePicked = Input::get('datePicked');
        $doctor_id = Input::get('doctor_id');
        $selectedSchedules = array();

        $schedules = Schedule::all();

        foreach ($schedules as $schedule){
            if (!$this->checkIfScheduleAvail($doctor_id, $schedule->time, $datePicked)){
                $selectedSchedules[] = $schedule->time;
            }
        }

        //$response = ['success' => true, 'data' => [$selectedSchedules]];
        $response = ['success' => true, 'data' => [$selectedSchedules]];
        $this->jsonResponse($response);

        //dnd($selectedSchedules);

        //dnd($schedudes->find(2)->time);
    }

    public function checkIfScheduleAvail($doctor_id, $time, $date){
        $flag = false;
        $appointments = Appointment::all();
        foreach ($appointments as $appointment){
            if ($appointment->date == $date && $appointment->doctor_id == $doctor_id && $appointment->time = $time){
                $flag = true;
                break;
            }
        }
        return $flag;
    }


    public function bookingPostAction(){
        $slot = Input::get('slot');
        $datePicked = Input::get('datePicked');
        $doctor_id = Input::get('doctorId');
        //$docotor = Doctor::all()->find()
        //dnd($datePicked);
        $appointment = new Appointment();

        $schedule_id = Schedule::all()->find($slot)->id;

        $appointment->saveAppointment($schedule_id, $doctor_id, $datePicked);
        $appointments = Appointment::all();

        $_SESSION['doctor'] = Doctor::all()->find($doctor_id);
        $_SESSION['slot'] = $slot;


        foreach ($appointments as $current){
            if ($current->schedule_id == $slot && $current->date == $datePicked){
                $appointment = $current;
                break;
            }
        }
        $this->view->render('appointment/bookingDetails', $appointment);
    }

}