<?php

use Facade\Gate;

require_once "../app/view/components/header.php";
require_once "../app/view/components/navbar.php";
?>

<h1 class="text-center font-semibold text-4xl">Our Menu</h1>
<div class="flex justify-center w-full">

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 py-10 gap-10">
        <?php foreach ($data["products"] as $product): ?>
            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                <figure class="h-64 w-full overflow-hidden"><img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($product['imagePath'])?>"
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

    <script>
        let isLoading = false
        $(window).scroll(()=>{

            if($(window).scrollTop() + $(window).height() >= $(document).height()){
                // console.log("Bottom");
                isLoading = true;
                $.ajax({
                    url: '<?php echo BASEURL . "/menu/product"?>',
                    method: "GET",
                    success: (response)=>{
                        $(".grid").append(response);
                        isLoading = false;
                    },

                })

            }
        })
    </script>