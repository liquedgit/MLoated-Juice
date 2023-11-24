<?php

use Facade\Gate;
use Facade\Middleware;
class Menu extends Controller
{
    protected $title = "Menu";
    public function index(){
        Middleware::authenticatedOnly();

        $_SESSION["lastProduct"] = 6;
        $currUser = $_SESSION["USER"];
        $activeRole = $_SESSION["USER"]["roles"][0];
        if(isset($_SESSION["activeRole"])) {
            $activeRole = $_SESSION["activeRole"];
        }

        $products = $this->model("Product")->GetProductsPaginated(6, 0);
        if(isset($_GET["search"])){
            $products = $this->model("Product")->GetProductByName($_GET["search"]);
        }
        $this->view('Menu/index', $this->title,[
            "currUser"=>$currUser,
            "activeRole"=>$activeRole,
            "products"=> $products
        ]);
    }

    public function product() {
        $lastProduct = $_SESSION["lastProduct"];
        $_SESSION["lastProduct"] = $lastProduct + 3;
        $activeRole = $_SESSION["USER"]["roles"][0];
        if (isset($_SESSION["activeRole"])) {
            $activeRole = $_SESSION["activeRole"];
        }

        $products = $this->model("Product")->GetProductsPaginated(6, $lastProduct);
        foreach ($products as $product) {
            ?>
            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                <figure class="h-64 w-full overflow-hidden">
                    <img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($product['imagePath']); ?>"
                         alt="<?php echo htmlspecialchars($product['productName']); ?>" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title"><?php echo htmlspecialchars($product['productName']); ?></h2>
                    <p><?php echo htmlspecialchars($product['productDescription']); ?></p>
                    <div class="flex justify-end">
                        <?php if (Gate::activeRoleIsAdmin($activeRole)): ?>
                            <div class="card-actions mr-3">
                                <button onclick="window.location.href='<?php echo BASEURL . '/juice/details/' . $product['id']; ?>'" class="btn btn-warning">Edit Juice</button>
                            </div>
                        <?php else: ?>
                            <div class="card-actions">
                                <button onclick="window.location.href='<?php echo BASEURL .'/juice/details/'. $product["id"]?>'" class="btn btn-info">Order Juice</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}