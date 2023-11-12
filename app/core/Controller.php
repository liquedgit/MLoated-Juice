<?php
session_start();
class Controller{
    public function view($view,$title ,$data = []){
        require_once '../app/view/layout.php';
    }

    public function model($model){
        require_once '../app/model/' .$model.'.php';
        return new $model;
    }
}