<?php


class AuthorizationHelper
{
    //Check if authorization is required
    public static function isLoginRequired($controller){

        if ($controller == self::formatController('doctor') || $controller == self::formatController('nurse') || $controller == 'AdminController' || $controller == 'AdminController' || $controller == 'AppointmentController'){
            return true;
        }
        else{
            return false;
        }
    }

    //Format controller
    public static function formatController($controller){
        return ucwords($controller).'Controller';
    }

    public static function properRedirectToMatchedProfile($id){

    }
}