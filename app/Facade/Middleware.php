<?php

namespace Facade;

class Middleware{
    public static function authenticatedOnly(){
        if(!isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/login", true);
        }
    }

    public static function guestOnly(){
        if(isset($_SESSION["USER"])){
            header("Location: ". BASEURL. "/home", true);
        }
    }

    public static function adminOnly(){
        if(!isset($_SESSION["activeRole"]) && $_SESSION["activeRole"] !== "Admin"){
            header("Location: ". BASEURL."/home", true);
        }
    }
}