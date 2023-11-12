<?php

class Error404 extends Controller{
    protected $title = "404 Not found";
    public function index(){
        return $this->view('Error404/index', $this->title);
    }
}