<?php


class App
{
    protected $controller = 'HomeController';

    protected $method = 'index';

    protected $param = [];

    public function __construct()
    {
        $this->parseUrl();
        //echo "Hello...!";
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])){
            echo $_GET['url'];
        }
    }
}