<?php

class Router {
    public static function route($url){

        //controller
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) .'Controller' : DEFAULT_CONSTRUCTOR;
        $controller_name = $controller;
        array_shift($url);

        //action
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
        $action_name = $controller;
        array_shift($url);

        //params
        $queryParams = $url;

        //dnd(LoginHelper::isLoggedIn());
//        if (AuthorizationHelper::isLoginRequired($controller) && !LoginHelper::isLoggedIn()){
//            $controller = 'AuthController';
//            $action = 'loginAction';
//            dnd($controller);
//        }
        if (AuthorizationHelper::isLoginRequired($controller) && !LoginHelper::isLoggedIn()){
            //Router::redirect('auth/login');
            session_destroy();
            header('Location: '.SROOT.'auth/login');
        }


        $dispatch = new $controller($controller_name, $action);

        //dnd($controller.'---'.$controller_name.'----'.$action);



        //dnd($dispatch);

        if (method_exists($controller, $action)){
            //dnd($controller.$action);



            call_user_func_array([$dispatch, $action], $queryParams);
        }
        else{
            die('Method does not exist in the controller\"'.$controller_name.'\"');
        }
        //dnd($url);
    }

    public static function redirect($location, $msg=null){
        if (!headers_sent()){
            if ($msg!=null){
                header('Location:'.SROOT.$location."?msg=".$msg);
            }else{
                header('Location:'.SROOT.$location);
            }
            //header('Location:'.SROOT.$location);
            exit;
        }else{
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.SROOT.$location.'";';
            echo '</script>';
            echo '</noscript>';
            echo '<meta> http-equiv="refresh" content="0;url='.$location.'"/>';
            echo '</noscript>';exit;
        }
    }
}