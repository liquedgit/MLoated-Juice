<?php

class Logout
{
    public function index(){
        setcookie(USER_SESSION, "", time() - 3600, "/");
        header("Location: ". BASEURL. "/login");
    }
}