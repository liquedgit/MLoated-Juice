<?php

use Facade\Middleware;
class Roles{
    public function activeRoles(){
        Middleware::authenticatedOnly();
        if(!isset($_SESSION["activeRole"])){
            $_SESSION["activeRole"] = $_REQUEST["option"];
        }

        $_SESSION["activeRole"] = $_REQUEST["option"];

        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}