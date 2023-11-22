<?php
use Facade\Preventor;
use Facade\Middleware;

class Login extends Controller{

    protected $title = "Login";
    protected $userModel = "User";

    public function index(){
        Middleware::guestOnly();
        Preventor::CSRFGenerate();
        $this->view("Login/index", $this->title);
    }

    public function authenticate(){
        Middleware::guestOnly();
        unset($_SESSION["error_message"]);
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            if(Preventor::CSRFCheck($_REQUEST['csrf_token'])) {
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