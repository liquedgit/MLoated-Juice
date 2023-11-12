<?php

class Home extends Controller {
    protected $title = "Home";

    public function index(){
        if(!isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/login");
        }

        $currUser = $_SESSION["USER"];

        $this->view('Home/index', $this->title,[
            "currUser"=>$currUser
        ]);
    }


}