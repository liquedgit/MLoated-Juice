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
            unset($_SESSION["juice_name_error_message"]);
            unset($_SESSION["juice_price_error_message"]);
            unset($_SESSION["juice_desc_error_message"]);
            unset($_SESSION["juice_file_error_message"]);
            unset($_SESSION["juiceName"]);
            unset($_SESSION["juicePrice"]);
            unset($_SESSION["juiceDescription"]);
//            var_dump($_POST);
//            var_dump($_FILES);

            $juiceName = $_POST["juiceName"];
            $juicePrice = (int)$_POST["juicePrice"];
            $juiceDesc = $_POST["juiceDescription"];
            $file = $_FILES["fileUpload"];

            $_SESSION["juiceName"] = $juiceName;
            $_SESSION["juicePrice"] = $juicePrice;
            $_SESSION["juiceDescription"] = $juiceDesc;


            if($juiceName === "") {
                $_SESSION["juice_name_error_message"] = "Juice name cannot be empty";
            }else if(strlen($juiceName) < 5 || strlen($juiceName) > 20){
                $_SESSION["juice_name_error_message"] = "Juice name cannot be less than 5 or more than 20 character";
            }

            if($juicePrice <= 0 || $juicePrice >= 50000){
                $_SESSION["juice_price_error_message"] = "Juice price cannot be less than or equals to 0 and more than or equals to 50000";
            }

            if($juiceDesc === ""){
                $_SESSION["juice_desc_error_message"] = "Juice description cannot be empty";
            }else if(strlen($juiceDesc) < 10 || strlen($juiceDesc) > 100){
                $_SESSION["juice_desc_error_message"] = "Juice description length cannot be less than 10 or more than 100 character";
            }

            $allowedMimetypes = array("image/jpeg", "image/png", "image/jpg");
            if($file["size"] <= 0){
                $_SESSION["juice_file_error_message"] = "File cannot be empty !";
            }else if($file["size"] > 5000000){
                $_SESSION["juice_file_error_message"] = "File cannot be more than 5 MB";
            }else if(!in_array($file["type"], $allowedMimetypes)){
                $_SESSION["juice_file_error_message"] = "File must be an image !";
            }


            if(isset($_SESSION["juice_file_error_message"]) || isset($_SESSION["juice_name_error_message"])
                || isset($_SESSION["juice_desc_error_message"]) || isset($_SESSION["juice_price_error_message"])
            ){
                header("Location:". BASEURL. "/juice/create");
                return;
            }

            $newFilePath = "img/" . uniqid() . $file["name"];
            move_uploaded_file($file["tmp_name"], "../app/asset/".$newFilePath);
            $this->model("Product")->AddNewProduct($juiceName, $juiceDesc, $juicePrice,$newFilePath);
            $_SESSION["create_success_message"] = "Successfully created " . $file["name"];
            header("Location: ". BASEURL ."/home");
        }
    }

    public function details($id){
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            if(!isset($_SESSION["USER"])){
                header("Location: " .BASEURL."/login");
            }

            $currUser = $_SESSION["USER"];
            $activeRole = $_SESSION["USER"]["roles"][0];
            if(isset($_SESSION["activeRole"])){
                $activeRole = $_SESSION["activeRole"];
            }

            $product = $this->model("Product")->GetProductById($id);

            $this->view("Juice/index", "Juice Detail", [
                "currUser"=>$currUser,
                "activeRole"=> $activeRole,
                "product"=>$product
            ]);
        }else if($_SERVER["REQUEST_METHOD"] === "POST"){
            var_dump($_REQUEST);
        }
    }
}