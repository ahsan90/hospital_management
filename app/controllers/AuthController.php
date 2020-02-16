<?php
/*
 * Author: Md Ahsanul Hoque
 * Date: February 7, 2020
 * Purpose: Controller for dealing with login/logout functionality
 *
 */

class AuthController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function createUserAction(){
        $this->view->render('auth/register');
    }

    public function loginAction(){
        //if the user already logged redirect him to home page instead of login page
        if (LoginHelper::isLoggedIn()){
            //dnd('You already logged in....!!');
            Router::redirect('home');
        }
        $this->view->render('auth/login');
    }

    public function loginPostAction(){
        $username = Input::get('username');
        $password = Input::get('password');


        //Validate login and redirect to appropriate profile(admin/doctor/nurse/patient) based on the login credential
        if (LoginHelper::isValidUser($username, $password)){
            //dnd($_SESSION['password']);
            $msg = "<p class='alert alert-success'>Login successful..!</p>";
            if (LoginHelper::isAdmin()){
                Router::redirect('admin',$msg);
            }
            elseif (LoginHelper::isACurrentPatient()){
                $patient = UserHelper::getCurrentLoggedInPatient();
                Router::redirect('patient/profile/'.$patient->id, $msg);
            }
            elseif (LoginHelper::isACurrentNurse()){
                $nurse = UserHelper::getCurrentLoggedInNurse();
                Router::redirect('nurse/profile/'.$nurse->id, $msg);
            }
            elseif (LoginHelper::isACurrentDoctor()){
                $doctor = UserHelper::getCurrentLoggedInDoctor();
                Router::redirect('doctor/profile/'.$doctor->id, $msg);
            }else{
                Router::redirect('home');
            }
            //$this->view->render('test', $msg);
        }else{
            $msg = "<p class='alert alert-danger'>Invalid Username/Password combination</p>";
            Router::redirect('auth/login', $msg);
            //dnd("Login failed...!");
        }
    }

    //Logout Action
    public function logoutAction(){
        //if not logged in automatically redirect to login page
        if (!LoginHelper::isLoggedIn()){
            Router::redirect('auth/login');
        }
        LoginHelper::logout();
        $msg = "<p class='alert alert-success'>You have been successfully logged out</p>";
        //$this->view->render('home', $msg);
        Router::redirect('home', $msg);
    }
}