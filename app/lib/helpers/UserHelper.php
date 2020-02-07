<?php


class UserHelper
{
    public static function findUserIdByUsername($username){
        $user_id = User::all()->where('username', $username)->first()->id;
        return $user_id;
    }


    //Find patient based on current logged in user
    public static function getCurrentLoggedInPatient(){
        $user = LoginHelper::getCurrentUser();
        $patient = Patient::all()->where('user_id', $user->id)->first();
        return $patient;
    }

    //Find nurse based on current logged in user
    public static function getCurrentLoggedInNurse(){
        $user = LoginHelper::getCurrentUser();
        $nurse = Nurse::all()->where('user_id', $user->id)->first();
        return $nurse;
    }

    //Find doctor based on current logged in user
    public static function getCurrentLoggedInDoctor(){
        $user = LoginHelper::getCurrentUser();
        $doctor = Doctor::all()->where('user_id', $user->id)->first();
        return $doctor;
    }

    //Find Patient based on healthcardNumber
    public static function getPatientBasedOnHealthCardNo($healthCardNo){
        $patient = Patient::all()->where('healthCardNumber', $healthCardNo)->first();
        return $patient;
    }
}