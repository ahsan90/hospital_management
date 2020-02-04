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
        $selectedDoctorSpecialist = array();
        $doctors = Doctor::all();

        foreach ($selectedDoctorSpecialist as $current){
            //$doctors =
        }

        if ($doctors){
            $_SESSION['doctors'] = $doctors;
        }else{
            $_SESSION['doctors'] = "";
        }

        $this->view->render('appointment/search');
    }

    public function bookingAction(){
        if ($_POST){
            $specialization = Input::get('specialization');
            $datePicked = Input::get('date');
            $doctorsOnSpecialization = Doctor::all()->where('specialization', $specialization);
            if ($doctorsOnSpecialization){
                $_SESSION['doctors'] = $doctorsOnSpecialization;
            }else{
                $_SESSION['doctors'] = "";
            }

            $doctor_id = Input::get('doctor_id');

            $_SESSION['datePicked'] = $datePicked;


            $selectedSchedules = array();

            $schedule = Appointment::all()->where('date', $datePicked)->first();

            if ($schedule){

                foreach (Schedule::all() as $current){

                    if ($current->id != $schedule->schedule_id && $schedule->doctor_id != $doctor_id){
                        array_push($selectedSchedules, $current);
                    }elseif ($current->id == $schedule->schedule_id && $schedule->doctor_id != $doctor_id){
                        if ($this->checkScheduleIsDifferent($current->time, $current->id))
                        array_push($selectedSchedules, $current);
                    }
                }
                $_SESSION['slots'] = $selectedSchedules;
            }
            else{
                $_SESSION['slots'] = Schedule::all();
                //dnd('not found');
            }

        }

        $this->view->render('appointment/book');
    }

    private function checkScheduleIsDifferent($currentTime, $id){
        $time = Schedule::all()->find($id)->time;
        return $time != $currentTime;
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