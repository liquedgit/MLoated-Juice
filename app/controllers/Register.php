<?php

class Register extends Controller{

    protected $title = "Register ";
    public function index(){
        if(isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/home");
        }
        if(!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $this->view("Register/index", $this->title);
    }

    public function auth(){
        unset($_SESSION["error_message"]);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if($_REQUEST['csrf_token'] === $_SESSION["csrf_token"]){


                $username = $_REQUEST["username"];
                $password = $_REQUEST["password"];
                $confirmPassword = $_REQUEST["confirmPassword"];
                $dob = $_REQUEST["DOB"];
//                var_dump($this->ValidateAge($dob));
                $user = $this->model("User")->GetUserByUsername($username);
                if($username === "" || $password === "" || $confirmPassword === "" || $dob === "" ||
                    !isset($_REQUEST["gender"])){
                    $_SESSION["error_message"] = "Please fill in all the fields";
                }else if($user){
                   $_SESSION["error_message"] = "Username must be unique !";
                }else if(!$this->ValidatePassword($password,$confirmPassword)){
                    $_SESSION["error_message"] = "Password and confirm password must be the same";
                }else if(!$this->ValidateAge($dob)){
                    $_SESSION["error_message"] = "You must be over 17 years old to create an account";
                }else{
                    $gender = $_REQUEST["gender"];
                    var_dump("Registering");
                    $this->model("User")->RegisterUser($username, $password, $dob, $gender);
                }
            }else{
                $_SESSION["error_message"] = "CSRF Token is not Valid";
            }

        }


        header("Location: " . BASEURL . "/register");
    }

    private function ValidatePassword($password, $confirmPassword): bool
    {
        if($password === $confirmPassword){
            return true;
        }
        return false;
    }

    /**
     * @throws Exception
     */
    private function ValidateAge($dob): bool
    {
        $userDob = new DateTime($dob);
        $today = new DateTime('today');
        $year = $userDob->diff($today)->y;
        var_dump($year);
        if($year > 17){
            return true;
        }
        return false;
    }

}
