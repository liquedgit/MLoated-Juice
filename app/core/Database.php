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
                "roles"=> ["User", "Admin"],
                "profileImagePath"=> ASSET_PATH_APP . "img/logo.png"
            ];
            $user_data = [
                "username" => "liqued",
                "password"=> password_hash("testing123", PASSWORD_BCRYPT),
                "dob" => "2003-10-10",
                "gender"=> "male",
                "roles"=>["User"],
                "profileImagePath"=> ASSET_PATH_APP . "img/logo.png"
            ];
            $product1 = [
                "id" => uniqid(),
                "productName"=>"Mango Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/mango-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 30000,
            ];
            $product2 = [
                "id" => uniqid(),
                "productName"=>"Strawberry Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/strawberry-juice.png",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 25000,
            ];
            $product3 = [
                "id" => uniqid(),
                "productName"=>"Avocado Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/alpukat-juice.png",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 27500,
            ];
            $product4 = [
                "id" => uniqid(),
                "productName"=>"Apple Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/apple-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 20000,
            ];
            $product5 = [
                "id" => uniqid(),
                "productName"=>"Blueberry Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/blueberry-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 35000,
            ];
            $product6 = [
                "id" => uniqid(),
                "productName"=>"Kiwi Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/kiwi-juice.jpeg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 28000,
            ];
            $product7 = [
                "id" => uniqid(),
                "productName"=>"Dragon fruit Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/naga-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 27500,
            ];
            $product8 = [
                "id" => uniqid(),
                "productName"=>"Watermelon Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi ut tortor vel ligula vehicula pretium in aliquam lacus. Fusce dolor diam, tristique ut massa ut, ultricies cursus augue. Donec ultricies, neque non pulvinar convallis.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/watermelon-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 22500,
            ];

            $this->data['users'][] = $admin_data;
            $this->data["users"][] = $user_data;
            $this->data["products"][]=$product1;
            $this->data["products"][]=$product2;
            $this->data["products"][]=$product3;
            $this->data["products"][]=$product4;
            $this->data["products"][]=$product5;
            $this->data["products"][]=$product6;
            $this->data["products"][]=$product7;
            $this->data["products"][]=$product8;
            setcookie("DATA", json_encode($this->data), time() + 86400, "/MLoated-Juice/");
        }
    }

    public function GetProducts(){
        return $this->data["products"];
    }

    public function AddProducts(){

    }

    public function GetUsers(){
        return $this->data['users'];
    }

    public function AddUsers($username, $password,$dob, $gender, $roles){
        $newUser = [
            "username"=>$username,
            "password"=> password_hash($password, PASSWORD_BCRYPT),
            "dob" => $dob,
            "gender"=> $gender,
            "roles"=>$roles
        ];
        $this->data["users"][] = $newUser;
        $this->saveDataToCookie();
    }

    private function saveDataToCookie()
    {
        setcookie("DATA", json_encode($this->data), time() + 86400, "/MLoated-Juice/");
    }

}