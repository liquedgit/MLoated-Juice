<?php


class Database
{
    private $user = [];

    private function __construct()
    {
        var_dump("Created new instance");
        require_once ('../app/model/User.php');
        array_push($this->user, new User("liqued", "testing123"));
        array_push($this->user, new User("liqued2", "testing123"));
        array_push($this->user, new User("liqued3", "testing123"));
        array_push($this->user, new User("liqued4", "testing123"));
    }

    public static function GetInstance(){
        var_dump($GLOBALS["database"]);
        if(!isset($GLOBALS["database"])){
            require_once "../app/core/Database.php";
            $GLOBALS['database'] = new Database();
        }

        var_dump($GLOBALS["database"]);
        return $GLOBALS['database'];
    }

    public function GetUsers(){
        return $this->user;
    }

}