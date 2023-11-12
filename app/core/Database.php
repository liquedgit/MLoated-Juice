<?php


class Database
{

    private $data = [
        'users' => [],
        'products' => []
    ];
    public function __construct()
    {
        if (isset($_COOKIE["DATA"])) {
            $this->data = json_decode($_COOKIE["DATA"], true);
        } else {
            $admin_data = [
                "username"=>"admin",
                "password"=> password_hash("admin" , PASSWORD_BCRYPT),
                "dob" => "2003-10-10",
                "gender"=> "male",
                "roles"=> ["User", "Admin"]
            ];
            $user_data = [
                "username" => "liqued",
                "password"=> password_hash("testing123", PASSWORD_BCRYPT),
                "dob" => "2003-10-10",
                "gender"=> "male",
                "roles"=>["User"]
            ];

            $this->data['users'][] = $admin_data;
            $this->data["users"][] = $user_data;
            setcookie("DATA", json_encode($this->data));
        }
    }

    public function GetUsers(){
        return $this->data['users'];
    }

    public function AddUsers($username, $password,$dob, $gender, $roles){
        $newUser = [
            "username"=>$username,
            "password"=> password_hash($password, PASSWORD_BCRYPT),
            "roles"=>$roles
        ];
        $this->data["users"][] =$newUser;
        $this->saveDataToCookie();
    }

    private function saveDataToCookie()
    {
        setcookie("DATA", json_encode($this->data));
    }

}