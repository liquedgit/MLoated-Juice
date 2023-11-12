<?php

class Logout
{
    public function index(){
        session_destroy();
        setcookie(USER_SESSION, "", time() - 3600, "/".PROJECT_NAME."/");
        header("Location: ". BASEURL. "/login");
    }
}