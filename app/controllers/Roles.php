<?php

class Roles{
    public function activeRoles(){
        if(!isset($_SESSION["activeRole"])){
            $_SESSION["activeRole"] = $_REQUEST["option"];
        }

        $_SESSION["activeRole"] = $_REQUEST["option"];

        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}