<?php


class LoginHelper
{

    public function __construct()
    {
    }

    //set initial session values
    public static function setInitialSessionValuesIfNotSet(){
        if (!isset($_SESSION['username'])){
            $_SESSION['username'] = null;
        }
        if (!isset($_SESSION['password'])){
            $_SESSION['password'] = null;
        }
        if (!isset($_SESSION['role_type'])){
            $_SESSION['role_type'] = null;
        }
        if (!isset($_SESSION['user_id'])){
            $_SESSION['user_id'] = null;
        }
    }

    //check if the user is loggedIn
    public static function isLoggedIn(){
        self::setInitialSessionValuesIfNotSet();
        if ($_SESSION['username'] != null){
            if (self::isValidUser($_SESSION['username'],$_SESSION['password'])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    //Verify username and password for login
    public static function isValidUser($username, $password){
        $flag = false;

        self::setInitialSessionValuesIfNotSet();

        $users = User::all();

        foreach ($users as $user){
            //check if the username and password exist in the database
            if ($user->username == $username && $user->password == md5($password)){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['user_id'] = $user->id;
                $_SESSION['role_type'] = Role::all()->where('id', $user->role_id)->first()->roleType;
                $flag = true;
                break;
            }
        }
        return $flag;
    }

    public static function logout(){
        session_destroy();
    }

    public static function currentUser($id){
        $flag = false;
        $user = User::all()->find($id);
        if (self::isLoggedIn()){
            if ($user){
                if($user->username == $_SESSION['username']){
                    $flag = true;
                }
            }
        }
        return $flag;
    }

    //get currently loggedIn user
    public static function getCurrentUser(){
        if (self::isLoggedIn()){
            $currentUser = User::all()->where('username', $_SESSION['username'])->first();
            return $currentUser;
        }
    }

    //check if the user is admin
    public static function isAdmin(){
        if (self::isLoggedIn()){
            if ($_SESSION['role_type'] == "admin"){
                return true;
            }else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    //check if the current user is a doctor
    public static function isACurrentDoctor(){
        $flag = false;
        if (self::isLoggedIn()){

            //$role_id = Doctor::all()->where('user_id', $_SESSION['user_id'])->first()->role_id;
            $doctor = Doctor::all()->where('user_id', $_SESSION['user_id'])->first();
            if (!$doctor) return false;
            $roleType = Role::all()->where("id", $doctor->role_id)->first()->roleType;

            //if ($role_id != null && $roleType !=null && ($roleType == "doctor")) $flag = true;
            if($roleType == "doctor") $flag = true;
        }
        return $flag;
    }

    //check if the current user is a nurse
    public static function isACurrentNurse(){
        $flag = false;
        if (self::isLoggedIn()){
            //$role_id = Nurse::all()->where('user_id', $_SESSION['user_id'])->first()->role_id;
            $nurse = Nurse::all()->where('user_id', $_SESSION['user_id'])->first();
            if (!$nurse) return false;
            $roleType = Role::all()->where("id", $nurse->role_id)->first()->roleType;
            if($roleType == "nurse") $flag = true;
        }
        return $flag;
    }

    //check if the current user is patient
    public static function isACurrentPatient(){
        $flag = false;
        if (self::isLoggedIn()){
            //$role_id = Patient::all()->where('user_id', $_SESSION['user_id'])->first()->role_id;
            $patient = Patient::all()->where('user_id', $_SESSION['user_id'])->first();
            if (!$patient) return false;
            $roleType = Role::all()->where("id", $patient->role_id)->first()->roleType;
            if($roleType == "patient") $flag = true;
        }
        return $flag;
    }

    //check if there is no user logged in
    public static function isNone(){

    }

}