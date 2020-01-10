<?php
//require '../../vendor/autoload.php';


//extends BaseController
class HomeController extends BaseController
{
    public function index(){
        //echo "Hello from home/index controller";
        $this->render('home/index', "Ahsan");
    }
}