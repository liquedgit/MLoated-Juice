<?php

class Home extends Controller {
    protected $title = "Home";

    public function index(){
        if(!isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/login");
        }

        $currUser = $_SESSION["USER"];
        $activeRole = $_SESSION["USER"]["roles"][0];
        if(isset($_SESSION["activeRole"])){
            $activeRole = $_SESSION["activeRole"];
        }

        $latestProducts = $this->model("Product")->GetLatestProducts();
        $this->view('Home/index', $this->title,[
            "currUser"=>$currUser,
            "activeRole"=>$activeRole,
            "latestProducts"=> $latestProducts
        ]);
    }


}