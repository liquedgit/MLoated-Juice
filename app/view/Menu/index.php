<?php

use Facade\Gate;

require_once "./app/view/components/header.php";
require_once "./app/view/components/navbar.php";
?>
<div style="background-color: #242933">
    <h1 class="text-center font-semibold text-4xl py-10">Our Menu</h1>

    <div class="flex justify-center w-100 py-12" >

        <form class="w-1/2" method="get" action="<?php echo BASEURL . "/menu"?>">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" <?php
                if(isset($_GET["search"])):
                    ?>
                    value="<?php echo htmlspecialchars($_GET["search"]) ?>"
                <?php endif?>
                       name="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." required>
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

    </div>

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
                                    <button
                                            onclick="window.location.href='<?php echo BASEURL . "/juice/details/".$product["id"]?>'"
                                            class="btn btn-warning">Edit Juice</button>
                                </div>
                            <?php else: ?>
                                <div class="card-actions">
                                    <button class="btn btn-info"
                                            onclick="window.location.href='<?php echo BASEURL . "/juice/details/".$product["id"]?>'"
                                    >Order Juice</button>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <?php if(!isset($_GET["search"])) :?>
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
        <?php endif?>
</div>
