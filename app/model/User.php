<?php


class User implements JsonSerializable
{
    private $username;
    private $password;
    private $id;
    private $roles;

    public function __construct($username, $password,
                                $roles = ["User"])
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->roles = $roles;
        $this->id = uniqid();
    }

    public static function AuthenticateUser($username, $password){

        $localStorage = LocalStorage::getInstance();
        foreach ($localStorage->getUsers() as $user){
            if($user->username === $username && password_verify($password, $user->password)){
                var_dump("Authenticated");
            }
        }

    }

    public function getUsername(){
        return $this->username;
    }

    public function getRoles(){
        return $this->roles;
    }

    public function setRoles($roles){
        $this->roles = $roles;
    }

    public function jsonSerialize()
    {
        return [
            'username'=> $this->username,
            'password'=>$this->password,
            'id'=> $this->id,
            '$roles'=> $this->roles
        ];
    }
}