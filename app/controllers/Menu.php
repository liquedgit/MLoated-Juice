<?php

use helper\Gate;
class Menu extends Controller
{
    protected $title = "Menu";
    public function index(){
        if(!isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/login");
        }

        $_SESSION["lastProduct"] = 3;

        $currUser = $_SESSION["USER"];
        $activeRole = $_SESSION["USER"]["roles"][0];
        if(isset($_SESSION["activeRole"])) {
            $activeRole = $_SESSION["activeRole"];
        }
        $products = $this->model("Product")->GetProductsPaginated(3, 0);
        $this->view('Menu/index', $this->title,[
            "currUser"=>$currUser,
            "activeRole"=>$activeRole,
            "products"=> $products
        ]);
    }

    public function product(){
        $lastProduct = $_SESSION["lastProduct"];
        $_SESSION["lastProduct"] = $lastProduct + 3;
        $activeRole = $_SESSION["USER"]["roles"][0];
        if(isset($_SESSION["activeRole"])) {
            $activeRole = $_SESSION["activeRole"];
        }

        $products = $this->model("Product")->GetProductsPaginated(3, $lastProduct);
        foreach ($products as $product){
            echo '
                 <div class="card card-compact w-96 bg-base-100 shadow-xl">
                    <figure class="h-64 w-full overflow-hidden">
                        <img class="w-full h-full object-cover" src='. htmlspecialchars($product["imagePath"]) .'
                                                                     alt='. htmlspecialchars($product["productName"]) .' /></figure>
                    <div class="card-body">
                        <h2 class="card-title">'. htmlspecialchars($product["productName"]) .'</h2>
                        <p>'. htmlspecialchars($product["productDescription"]).'</p>
                        <div class="flex justify-end">';

            if(Gate::activeRoleIsAdmin($activeRole)){
                echo '<div class="card-actions mr-3">
                                <button class="btn btn-warning">Edit Juice</button>
                    </div>';
            }

            echo '
            <div class="card-actions">
                                <button class="btn btn-info">Order Juice</button>
                            </div>
                        </div>
                    </div>
                </div>';

        }
    }
}