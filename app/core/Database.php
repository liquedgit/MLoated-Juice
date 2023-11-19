<?php


class Database
{

    private $data = [
        'users' => [],
        'products' => []
    ];

    private $users = [];
    private $products = [];
    public function __construct()
    {
        if (isset($_COOKIE["USER"]) && isset($_COOKIE["PRODUCTS"])) {
            $this->users = json_decode(gzuncompress($_COOKIE["USER"]), true);
            $this->products = json_decode(gzuncompress($_COOKIE["PRODUCTS"]), true);
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
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/mango-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 30000,
            ];
            $product2 = [
                "id" => uniqid(),
                "productName"=>"Strawberry Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/strawberry-juice.png",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 25000,
            ];
            $product3 = [
                "id" => uniqid(),
                "productName"=>"Avocado Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/alpukat-juice.png",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 27500,
            ];
            $product4 = [
                "id" => uniqid(),
                "productName"=>"Apple Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/apple-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 20000,
            ];
            $product5 = [
                "id" => uniqid(),
                "productName"=>"Blueberry Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/blueberry-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 35000,
            ];
            $product6 = [
                "id" => uniqid(),
                "productName"=>"Kiwi Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/kiwi-juice.jpeg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 28000,
            ];
            $product7 = [
                "id" => uniqid(),
                "productName"=>"Dragon fruit Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/naga-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 27500,
            ];
            $product8 = [
                "id" => uniqid(),
                "productName"=>"Watermelon Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/watermelon-juice.jpg",
                "productPopularity"=> rand(0,5),
                "productPrice"=> 22500,
            ];

            $this->users[] = $admin_data;
            $this->users[] = $user_data;
            $this->products[]=$product1;
            $this->products[]=$product2;
            $this->products[]=$product3;
            $this->products[]=$product4;
            $this->products[]=$product5;
            $this->products[]=$product6;
            $this->products[]=$product7;
            $this->products[]=$product8;
            setcookie("USER", gzcompress(json_encode($this->users), 9), time() + 86400, "/". PROJECT_NAME ."/");
            setcookie("PRODUCTS", gzcompress(json_encode($this->products), 9), time() + 86400, "/". PROJECT_NAME ."/");
        }
    }

    public function GetProducts(){
        return $this->products;
    }

    public function AddProducts($juiceName,$juicePrice,$juiceDesc, $imagePath ){
        $newProduct = [
            "id" => uniqid(),
            "productName"=>$juiceName,
            "productDescription"=> $juiceDesc,
            "createdAt"=>time(),
            "updatedAt"=>time(),
            "imagePath" => ASSET_PATH_APP . $imagePath,
            "productPopularity"=> 0,
            "productPrice"=> $juicePrice,
        ];
        $this->products[] = $newProduct;
        setcookie("PRODUCTS", gzcompress(json_encode($this->products), 9), time() + 86400, "/". PROJECT_NAME ."/");

    }

    public function GetUsers(){

        return $this->users;
    }

    public function AddUsers($username, $password,$dob, $gender, $roles){
        $newUser = [
            "username"=>$username,
            "password"=> password_hash($password, PASSWORD_BCRYPT),
            "dob" => $dob,
            "gender"=> $gender,
            "imagePath"=> ASSET_PATH_APP . "img/logo.png",
            "roles"=>$roles
        ];
        $this->users[] = $newUser;
        setcookie("USER", gzcompress(json_encode($this->users), 9), time() + 86400, "/". PROJECT_NAME ."/");
    }


}