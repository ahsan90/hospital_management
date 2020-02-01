<?php

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;

class Validation
{
    static private $errorText;

    /**
     * @return mixed
     */
    public static function getErrorText()
    {
        return self::$errorText;
    }
    //Check if the the field is empty
    public static function isEmpty($input){
        if (empty($input) || $input == ""){
            self::$errorText = "cannot be empty!";
            return true;
        }else{
            return false;
        }
    }


    //Code Reference: https://packagist.org/packages/egulias/email-validator
    public static function isValidEmail($email){
        $validator = new EmailValidator();
        $multipleValidations = new MultipleValidationWithAnd([
            new RFCValidation(),
            new DNSCheckValidation()
        ]);

        if (!self::isEmpty($email) && $validator->isValid($email, $multipleValidations)){
            return true;
        }else{
            return false;
        }
    }

    public static function isUserExists($username){
        $user = User::all()->where('username', $username)->first();
        if ($user){
            return true;
        }else{
            return false;
        }
    }

    //Check if the health card number is exists
    public static function isHealthCardExists($healthCardNo){
        $patient = Patient::all()->where('healthCardNumber', $healthCardNo)->first();
        if ($patient){
            return true;
        }else{
            return false;
        }
    }

    public static function unsetCustomMsg($msg){
        if (isset($msg)){
            unset($msg);
        }
    }

    //Display custom message
    public static function customMessage($msg)
    {
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        } else {
            echo $msg;
        }
    }
    //Check if the price is valid
//    public static function isValidPrice($price){
//        if (empty($price) || !is_numeric($price) || $price<0) {
//            self::$errorText = "Please enter a valid price";
//            return false;
//        }else{
//            return true;
//        }
//    }
}