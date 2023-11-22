<?php


class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetAllUser(){
        return $this->db->GetUsers();
    }

    public function GetUserByUsername($username){
        $users = $this->db->GetUsers();
        foreach ($users as $user){
            if($user["username"] == $username){
                return $user;
            }
        }
        return null;
    }

    public function RegisterUser($username, $password, $dob, $gender, $roles = ["User"]){
        $this->db->AddUsers($username,$password, $dob, $gender,$roles);
    }

    public function updateProfile($username, $dob, $gender, $filePath){
        return $this->db->UpdateProfileByUsername($username, $dob, $gender, $filePath);
    }

    public function authenticate($username, $password){
        $user = $this->GetUserByUsername($username);
        if($user && password_verify($password, $user["password"])){
            return $user;
        }else{
            return null;
        }
    }

}