<?php

use Facade\Gate;
class Juice extends Controller
{
    public function create(){
        if(!isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/login");
        }

        $currUser = $_SESSION["USER"];
        $activeRole = $_SESSION["USER"]["roles"][0];
        if(isset($_SESSION["activeRole"])){
            $activeRole = $_SESSION["activeRole"];
        }

        if(!Gate::activeRoleIsAdmin($activeRole)){
            header("Location: ". BASEURL. "/home", true);
        }

        $this->view('Juice/create', "Create Juice", [
            "currUser"=>$currUser,
            "activeRole"=> $activeRole
        ]);
    }

    public function index(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //TODO : CREATE JUICE
            var_dump($_POST);
            var_dump($_FILES);
        }
    }
}