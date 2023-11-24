<?php

use Facade\Preventor;
use Facade\Middleware;
use Facade\Validator;
class Profile extends Controller
{


    public function index()
    {

        Middleware::authenticatedOnly();

        $currUser = $_SESSION["USER"];
        $activeRole = $_SESSION["USER"]["roles"][0];
        if (isset($_SESSION["activeRole"])) {
            $activeRole = $_SESSION["activeRole"];
        }
        Preventor::CSRFGenerate();

        $this->view("Profile/index", "Edit profile", [
            "currUser" => $currUser,
            "activeRole" => $activeRole,
        ]);
    }


    public function updateProfile(){
        Middleware::authenticatedOnly();

        unset($_SESSION["error_message"]);

        $username = $_SESSION["USER"]["username"];


        if(Preventor::CSRFCheck($_POST["csrf_token"])){
            if(Validator::isEmpty($_POST["displayName"], $_POST["bio"])){
                $_SESSION["error_message"] = "All fields cannot be empty !";
            }
            
            $path = parse_url($_SESSION["USER"]["profileImagePath"], PHP_URL_PATH);
         
            $newFilePath = "img/" . pathinfo($path, PATHINFO_BASENAME);

            if($_FILES["fileUpload"]["size"] !== 0){
                if(!Validator::validFileSize($_FILES["fileUpload"])){
                    $_SESSION["error_message"] = "Profile picture must be smaller than 10 KB and not more than 5 MB";
                }else if(!Validator::validFileMimeType($_FILES["fileUpload"])){
                    $_SESSION["error_message"] = "Attachment type is not supported. Please only upload JPEG, JPG, PNG !";
                }else{
                    $newFilePath = "img/" . $username . "profile";
                    move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "./app/asset/" . $newFilePath);
                }
            }

            

            if(isset($_SESSION["error_message"])){
                header("Location:" . $_SERVER["HTTP_REFERER"], true);
                return; 
            }
            

            $_SESSION["success_message"] = "Successfully updated profile";
            
            
            $updatedProfile = $this->model("User")->updateProfile($username,$_POST["displayName"], $_POST["bio"], $newFilePath);
            $_SESSION["USER"] = $updatedProfile;
            
        }else{
            $_SESSION["error_message"] = "CSRF token error !";
        }

        header("Location:" . $_SERVER["HTTP_REFERER"], true);

    }
}

