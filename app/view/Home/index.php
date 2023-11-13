<?php

use helper\Gate;

require_once "../app/view/components/header.php";
require_once "../app/view/components/navbar.php";
$latestProduct = end($data["latestProducts"]);
?>



<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <img src="<?php echo htmlspecialchars($latestProduct["imagePath"]);?>" class="max-w-sm rounded-lg shadow-2xl" />
        <div>
            <h1 class="text-5xl font-bold"><?php echo htmlspecialchars($latestProduct["productName"]). " 
            is now Available !"?></h1>
            <p class="py-6">
                <?php
                    echo htmlspecialchars($latestProduct["productDescription"])
                ?>
            </p>
            <button class="btn btn-info">Order Juice</button>
        </div>
    </div>
</div>

<div class="flex justify-center">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 py-10 gap-10">
        <?php foreach (array_reverse($data["latestProducts"]) as $product): ?>
            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                <figure><img src="<?php echo htmlspecialchars($product['imagePath'])?>"
                             alt="<?php echo htmlspecialchars($product['productName'])?>" /></figure>
                <div class="card-body">
                    <h2 class="card-title"><?php echo htmlspecialchars($product['productName'])?></h2>
                    <p><?php echo htmlspecialchars($product['productDescription'])?></p>
                    <div class="flex justify-end">
                        <?php
                            if(Gate::activeRoleIsAdmin($data["activeRole"])):
                        ?>
                            <div class="card-actions mr-3">
                                <button class="btn btn-warning">Edit Juice</button>
                            </div>
                        <?php endif;?>
                        <div class="card-actions">
                            <button class="btn btn-info">Order Juice</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
</div>
