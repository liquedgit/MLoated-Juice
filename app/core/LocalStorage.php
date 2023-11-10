<?php


class LocalStorage
{
    const FILENAME = "localStorage.json";
    protected static $instance = null;
    private $data = array();
    private $filename;

    protected function __construct($filename) {
        $this->filename = $filename;
        if(file_exists($this->filename))
            $this->data = json_decode(file_get_contents($this->filename));
        else{
            $this->data = array("users" => array());
            $this->data["users"][] = new User("liqued", "testing123");
            $this->data["users"][] = new User("liqued2", "testing123");
            $this->data["users"][] = new User("liqued3", "testing123");
            $this->data["users"][] = new User("liqued4", "testing123");
            $this->commit();
        }
        var_dump($this->data->users);
    }

    public static function getInstance($filename = self::FILENAME){
        if(self::$instance == null){
            self::$instance = new self($filename);
        }
        return self::$instance;
    }

    public function addUser($user)
    {
        $this->data["users"][] = $user;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function clearUsers()
    {
        $this->data["users"] = array();
    }

    public function getValue($key){
        if(isset($this->data->$key))
            return $this->data->$key;
        return $key;
    }

    public function clear(){
        $this->data = array();
    }

    public function commit(){
        file_put_contents($this->filename, json_encode($this->data));
    }

    public function toJson(){
        return json_encode($this->data);
    }

    public function __toString() {
        return $this->toJson();
    }

}