<?php


class LoginHelper
{
    private $username;
    private $password;
    private $role;

    public function __construct()
    {
    }

    //Check initial session values
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
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
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

    public static function isValidUser($username, $password){
        $flag = false;

        self::setInitialSessionValuesIfNotSet();

        $users = User::all();

        foreach ($users as $user){
            //check if the username and password exist in the database
            if ($user->username == $username && $user->password == md5($password)){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
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

    public static function currentUser(){

    }

    //check if the user is admin
    public static function isAdmin(){

    }

    //check if the user is a doctor
    public static function isDoctor(){

    }

    //check if the user is a nurse
    public static function isNurse(){

    }

    //check if the user is patient
    public static function isPatient(){

    }

    //check if there is no user logged in
    public static function isNone(){

    }

}