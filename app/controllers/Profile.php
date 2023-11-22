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
        var_dump($_POST);
        var_dump($_FILES);
        unset($_SESSION["error_message"]);

        $username = $_SESSION["USER"]["username"];


        if(Preventor::CSRFCheck($_POST["csrf_token"])){
            if(Validator::isEmpty($_POST["dob"], $_POST["gender"])){
                $_SESSION["error_message"] = "All fields cannot be empty !";
            }else if(!Validator::validFileSize($_FILES["fileUpload"])){
                $_SESSION["error_message"] = "Profile picture must be smaller than 10 KB and not more than 5 MB";
            }else if(!Validator::validFileMimeType($_FILES["fileUpload"])){
                $_SESSION["error_message"] = "Attachment type is not supported. Please only upload JPEG, JPG, PNG !";
            }else{
                $_SESSION["success_message"] = "Successfully updated profile";
                $newFilePath = "img/" . $username . $_FILES["fileUpload"]["name"];
                move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "../app/asset/" . $newFilePath);
                $updatedProfile = $this->model("User")->updateProfile($username, $_POST["dob"], $_POST["gender"], $newFilePath);
                $_SESSION["USER"] = $updatedProfile;
            }
        }else{
            $_SESSION["error_message"] = "CSRF token error !";
        }

        header("Location:" . $_SERVER["HTTP_REFERER"], true);

    }
}

