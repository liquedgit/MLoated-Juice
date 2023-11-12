<?php

class Login extends Controller{

    protected $title = "Login";
    protected $userModel = "User";

    public function index(){
        if(isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/home");
        }

        if(!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->view("Login/index", $this->title);
    }

    public function authenticate(){
        unset($_SESSION["error_message"]);
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            if($_REQUEST['csrf_token'] === $_SESSION["csrf_token"]) {
                //go to model and validate
                $user = $_REQUEST["username"];
                $password = $_REQUEST["password"];
                $authStatus = $this->model('User')->authenticate($user, $password);
                if ($authStatus) {
                    $_SESSION["USER"] = $authStatus;
                    if(isset($_REQUEST["rememberme"])){
                        setcookie(USER_SESSION, $authStatus["username"], time() + 86400, "/". PROJECT_NAME ."/");
                    }else{
                        setcookie(USER_SESSION, $authStatus["username"], time() + 3600, "/".PROJECT_NAME."/");
                    }

                    header("Location: ". BASEURL . "/home");
//                    return;
                }else{
                    $_SESSION["error_message"] = "Login Failed !";
                }
            }else{
                $_SESSION["error_message"] = "CSRF Token is not valid";
            }
            header("Location: ". BASEURL. "/login");
        }
    }

}