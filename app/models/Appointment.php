<?php
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model{
    protected $table = 'appointments';
    protected $guarded = [];

    public  static function isTheScheduleBooked($schedule){
        $tempTime = Appointment::all()->where('time', $schedule)->time;
        if ($tempTime){
            return true;
        }else{
            return false;
        }
    }

    public static function isTheDateAvailable($date){
        $tempDate = Appointment::all()->where('date', $date)->date;
        if ($tempDate){
            return true;
        }else{
            return false;
        }
    }

    public function saveAppointment($schedule_id, $doctor_id, $date){
        $appointment = new Appointment();
        $appointment->schedule_id = $schedule_id;
        $appointment->doctor_id = $doctor_id;
        $appointment->date = $date;
        $appointment->save();

        //Find out the newly created id of the appointment
        //$appointment_id = Appointment::all()->where('time' == $schedule && 'date' == $date);

        $appointmentHistory = new AppointmentHistory();
        //$appointmentHistory->appointment_id = $appointment_id;
        //$appointmentHistory->save();

    }

    public function saveAppointmentHistory(){}
}