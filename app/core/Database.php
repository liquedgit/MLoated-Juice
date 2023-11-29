<?php


class Database
{


    private $users = [];
    private $products = [];
    private $transactions = [];
    public function __construct()
    {
        if (isset($_COOKIE["USER"]) && isset($_COOKIE["PRODUCTS"]) && isset($_COOKIE["TRANSACTIONS"])) {
            $this->users = json_decode(gzuncompress($_COOKIE["USER"]), true);
            $this->products = json_decode(gzuncompress($_COOKIE["PRODUCTS"]), true);
            $this->transactions = json_decode(gzuncompress($_COOKIE["TRANSACTIONS"]), true);
        } else {
            $admin_data = [
                "username"=>"admin",
                "displayName"=>"Admin",
                "bio"=>"Hello i am just a humble admin",
                "password"=> password_hash("admin" , PASSWORD_BCRYPT),
                "dob" => "2003-10-10",
                "gender"=> "male",
                "roles"=> ["User", "Admin"],
                "profileImagePath"=> ASSET_PATH_APP . "img/logo.png"
            ];
            $user_data = [
                "username" => "liqued",
                "displayName"=>"Michael Bryan",
                "bio"=>"Hello i am just an ordinary Michael Bryan",
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
                "productPopularity"=> rand(1,5),
                "productPrice"=> 30000,
            ];
            $product2 = [
                "id" => uniqid(),
                "productName"=>"Strawberry Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/strawberry-juice.png",
                "productPopularity"=> rand(1,5),
                "productPrice"=> 25000,
            ];
            $product3 = [
                "id" => uniqid(),
                "productName"=>"Avocado Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/alpukat-juice.png",
                "productPopularity"=> rand(1,5),
                "productPrice"=> 27500,
            ];
            $product4 = [
                "id" => uniqid(),
                "productName"=>"Apple Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/apple-juice.jpg",
                "productPopularity"=> rand(1,5),
                "productPrice"=> 20000,
            ];
            $product5 = [
                "id" => uniqid(),
                "productName"=>"Blueberry Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/blueberry-juice.jpg",
                "productPopularity"=> rand(1,5),
                "productPrice"=> 35000,
            ];
            $product6 = [
                "id" => uniqid(),
                "productName"=>"Kiwi Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/kiwi-juice.jpeg",
                "productPopularity"=> rand(1,5),
                "productPrice"=> 28000,
            ];
            $product7 = [
                "id" => uniqid(),
                "productName"=>"Dragon fruit Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/naga-juice.jpg",
                "productPopularity"=> rand(1,5),
                "productPrice"=> 27500,
            ];
            $product8 = [
                "id" => uniqid(),
                "productName"=>"Watermelon Juice",
                "productDescription"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet odio a varius pharetra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.",
                "createdAt"=>time(),
                "updatedAt"=>time(),
                "imagePath" => ASSET_PATH_APP ."img/watermelon-juice.jpg",
                "productPopularity"=> rand(1,5),
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
            setcookie("USER", gzcompress(json_encode($this->users), 9), time() + 86400, "/");
            setcookie("PRODUCTS", gzcompress(json_encode($this->products), 9), time() + 86400, "/");
            setcookie("TRANSACTIONS", gzcompress(json_encode($this->transactions), 9), time() + 86400, "/");
        }
    }

    public function GetTransactions(){
        return $this->transactions;
    }

    public function AddTransactions($buyerUsername, $productId, $qty){
        $newTransactions = [
            "id" =>uniqid(),
            "buyer"=> $buyerUsername,
            "createdAt" => time(),
            "product"=> $productId,
            "quantity"=> $qty
        ];
        $this->transactions[] = $newTransactions;
        setcookie("TRANSACTIONS", gzcompress(json_encode($this->transactions), 9), time() + 86400, "/");
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
            "productPopularity"=> 1,
            "productPrice"=> $juicePrice,
        ];
        $this->products[] = $newProduct;
        setcookie("PRODUCTS", gzcompress(json_encode($this->products), 9), time() + 86400, "/");

    }

    public function UpdateProductById($productId, $newName, $newDesc,$newPrice, $newRating){
        foreach ($this->products as &$product){
            if($productId === $product["id"]){
                $product["productName"] = $newName;
                $product["productDescription"] = $newDesc;
                $product["productPrice"] = $newPrice;
                $product["productPopularity"] = $newRating;
                $product["updatedAt"] = time();
                break;
            }
        }
//        var_dump(json_encode($this->products));
        setcookie("PRODUCTS", gzcompress(json_encode($this->products), 9), time() + 86400, "/");
    }

    public function UpdateProfileByUsername($username, $displayName, $bio, $filePath){
        $user = null;
        foreach ($this->users as &$user){
            if($user["username"] === $username) {
                $user["displayName"] = $displayName;
                $user["bio"] = $bio;
                $user["profileImagePath"] = ASSET_PATH_APP . $filePath;
                break;
            }
        }
        setcookie("USER", gzcompress(json_encode($this->users), 9), time() + 86400, "/");
        return $user;
    }

    public function GetUsers(){

        return $this->users;
    }

    public function AddUsers($username,$displayName, $password,$dob, $gender, $roles){
        $newUser = [
            "username"=>$username,
            "password"=> password_hash($password, PASSWORD_BCRYPT),
            "displayName"=> $displayName,
            "bio"=>"",
            "dob" => $dob,
            "gender"=> $gender,
            "profileImagePath"=> ASSET_PATH_APP . "img/logo.png",
            "roles"=>$roles
        ];
        $this->users[] = $newUser;
        setcookie("USER", gzcompress(json_encode($this->users), 9), time() + 86400, "/");
    }


}