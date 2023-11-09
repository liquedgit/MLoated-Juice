<?php

class Login extends Controller{

    protected $title = "Login";
    protected $userModel = "User";

    public function index(){
        $this->view("Login/index", $this->title);
    }

    public function authenticate(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            if($_REQUEST['csrf_token'] === $_SESSION["csrf_token"]){
             //go to model and validate
                $user = $_REQUEST["username"];
                $password = $_REQUEST["password"];
                require_once '../app/model/User.php';
                $currUser = User::AuthenticateUser($user, $password);
                var_dump($currUser);
            }else{
                $_SESSION["error_message"] = "CSRF Token is not valid";
                header("Location: ". BASEURL. "/login");
            }
        }
    }

}