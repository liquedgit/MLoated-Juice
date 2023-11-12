<?php

class Roles{
    public function activeRoles(){
        if(!isset($_SESSION["activeRole"])){
            $_SESSION["activeRole"] = $_REQUEST["option"];
        }

        $_SESSION["activeRole"] = $_REQUEST["option"];
        $lastSlashPos = strrpos($_SERVER["HTTP_REFERER"], '/');
        $trimmedPath = substr($_SERVER["HTTP_REFERER"], $lastSlashPos);
        header("Location: " . BASEURL . $trimmedPath);
    }
}