<?php

class Home extends Controller {
    protected $title = "Home";

    public function index(){
        $this->view('Home/index', $this->title);
    }


}