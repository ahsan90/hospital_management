<?php


class BaseController
{
    public function model($model)
    {
        echo $model;
    }

    public function render($view, $data = null)
    {
        require_once './app/views/' . $view . '.php';
        return $view;
    }
}