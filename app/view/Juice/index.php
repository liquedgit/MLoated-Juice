<?php

use Facade\Gate;

require_once "../app/view/components/header.php";
require_once "../app/view/components/navbar.php";
?>

<?php
if(isset($_SESSION["error_message"])){
    echo '<div class="toast-notification" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                <div class="flex items-center bg-red-500 border-l-4 border-red-700 py-2 px-3 shadow-md mb-2" >
                    <div class="text-white max-w-xs ">'
        . $_SESSION["error_message"].
        '</div>
                </div>
              </div>';
}else if(isset($_SESSION["success_message"])){
    echo '<div class="toast-notification" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                <div class="flex items-center bg-green-500 border-l-4 border-green-700 py-2 px-3 shadow-md mb-2" >
                    <div class="text-white max-w-xs ">'
        . $_SESSION["success_message"].
        '</div>
                </div>
              </div>';
}

?>

    <div class="flex p-10 justify-center items-center">
        <div class="h-96 w-96 rounded-lg overflow-hidden">
            <img class="h-full w-full object-cover" src="<?php echo $data["product"]["imagePath"] ?>" alt="image description">
        </div>
        <?php if(Gate::activeRoleIsAdmin($data["activeRole"])): ?>
            <div class="flex flex-col px-10 py-4 max-w-2xl">
                <form method="POST" action="<?php echo BASEURL . "/juice/details/" . $data["product"]["id"]?>">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="flex justify-center">
                        <div>
                            <div>

                                <label for="productName">Product Name</label>
                                <input type="text" id="productName" placeholder="Product Name"
                                       value="<?php echo htmlspecialchars($data["product"]["productName"])?>" name="productName"
                                       class="input input-bordered w-full max-w-lg mt-2" />
                            </div>
                            <div class="mt-5">
                                <label for="productDesc">Product Description</label>
                                <textarea placeholder="Product description" id="productDesc"  name="productDesc" class="textarea textarea-bordered h-48 w-full mt-2"><?php
                                    echo htmlspecialchars($data["product"]["productDescription"])
                                    ?></textarea>
                            </div>
                        </div>
                        <div class="px-4">
                            <div>
                                <label for="productPrice">Product Price</label>
                                <input type="number" id="productPrice" placeholder="Product Price"
                                       value="<?php echo htmlspecialchars($data["product"]["productPrice"])?>" name="productPrice"
                                       class="input input-bordered w-full max-w-lg mt-2" />
                            </div>
                            <div class="mt-5">
                                <label for="productRating">Product Rating</label>
                                <input type="number" id="productRating" placeholder="Product Price"
                                       value="<?php echo htmlspecialchars($data["product"]["productPopularity"])?>"
                                       name="productRating"
                                       class="input input-bordered w-full max-w-lg mt-2" />
                            </div>
                        </div>
                    </div>


                    <div class="text-center mt-5">
                        <button class="btn btn-warning">Update product</button>
                    </div>


                </form>
            </div>
        <?php else:?>
            <?php
                unset($_SESSION["error_message"]);
                unset($_SESSION["success_message"]);
            ?>
            <div class="flex flex-col p-10 max-w-2xl">
                <h1 class="font-semibold text-4xl"><?php echo htmlspecialchars($data["product"]["productName"])?></h1>
                <span class="mt-5"><?php echo htmlspecialchars($data["product"]["productDescription"])?></span>
                <div class="rating rating-lg mt-5">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" name="rating-8" class="mask mask-star-2 bg-orange-400" disabled <?php echo ($i == $data["product"]["productPopularity"]) ? 'checked' : ''; ?> />
                    <?php endfor; ?>
                </div>
                <div class="join mt-5">
                    <form action="<?php echo BASEURL . "/transaction/create/" . $data["product"]["id"] ?>" method="POST">
                        <input class="input input-bordered join-item" name="quantity" type="number" placeholder="Quantity"/>
                        <button class="btn join-item rounded-r-full">Order</button>
                    </form>
                </div>
            </div>
        <?php endif ?>
    </div>
