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
        $doctors = Doctor::all();
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

            $_SESSION['datePicked'] = $datePicked;

            $appointments = Appointment::all();
            $schedules = Schedule::all();

            $selectedSchedules = array();

//            foreach ($appointments as $apt){
//                if ($datePicked == $apt->date){
//                    foreach ($schedules as $schedule){
//                        if (!$this->checkIfSlotAvailableforAppointment($appointments, $schedule->time)){
//                            array_push($selectedSchedules, $schedule->time);
//                            //$selectedSchedules = array_unique($selectedSchedules);
//                        }
//                    }
//
//                }
//                else{
//                    $selectedSchedules = array();
//                    foreach ($schedules as $schedule){
//                        array_push($selectedSchedules, $schedule->time);
//                    }
//                    //array_push($selectedSchedules, $schedules);
//                    $selectedSchedules = array_unique($selectedSchedules);
//                    break;
//                }
//            }
            foreach ($schedules as $schedule){
                if (!$this->checkIfSlotAvailableforAppointment($appointments, $schedule->time, $datePicked))
                array_push($selectedSchedules, $schedule);
            }
            //array_push($selectedSchedules, $schedules);
            $_SESSION['slots'] = $selectedSchedules;
//            if ($this->checkDateIsAvailable($appointments, $datePicked)){
//                foreach ($schedules as $schedule){
//
//                    if ($schedules->time == )
//                }
//            }

//            $slots = Schedule::all();
//            if (Appointment::isTheDateAvailable($datePicked)){
//                foreach ($slots as $slot){
//                    if (Appointment::isTheScheduleBooked($slot->time)){
//                        $_SESSION['slots'] = $slots->where('time' != $slot->time);
//                        break;
//                    }
//                }
//            }else {
//                $_SESSION['slots'] = $slots;
//            }

        }

        //dnd($_SESSION['slots']);
        //dnd($datePicked);
        $this->view->render('appointment/book');
    }

    private function checkIfSlotAvailableforAppointment($appointments, $slot, $date){
        foreach ($appointments as $appointment){
            if ($appointment->time == $slot && $appointment->date == $date)
            {
                return true;
            }else {
                return false;
            }
        }
    }

    private function checkSlotIsAvailable($schedules, $slot){
        foreach ($schedules as $schedule){
            if ($schedule->time == $slot){
                return true;
            }else{
                return false;
            }
        }
    }

    private function checkDateIsAvailable($appointments, $datePicked){
        $flag = false;
        foreach ($appointments as $appointment){
            if ($appointment->date == $datePicked){
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
        $appointment->saveAppointment($slot, $doctor_id, $datePicked);
        $appointments = Appointment::all();
        foreach ($appointments as $current){
            if ($current->time == $slot && $current->date == $datePicked){
                $appointment = $current;
                break;
            }
        }
        $this->view->render('appointment/bookingDetails', $appointment);
    }

}