<?php

namespace Facade;

class Preventor
{

    public static function CSRFGenerate(){
        unset($_SESSION["csrf_token"]);
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }

    public static function CSRFCheck($csrf_token){
        if(isset($_SESSION["csrf_token"])){
            if($_SESSION["csrf_token"] === $csrf_token){
                return true;
            }
        }

        return false;
    }

}