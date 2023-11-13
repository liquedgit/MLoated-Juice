<?php

namespace helper;

class Gate
{
    public static function isAdmin($user){
        if(in_array("Admin", $user["roles"])){
            return true;
        }
        return false;
    }

    public static function activeRoleIsAdmin($activeRole)
    {
        if($activeRole === "Admin"){
            return true;
        }
        return false;
    }
}