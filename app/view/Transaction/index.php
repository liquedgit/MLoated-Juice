<?php

use Facade\Gate;

require_once "./app/view/components/header.php";
require_once "./app/view/components/navbar.php";
?>

<h1 class="text-center text-4xl font-semibold p-10">
    <?php if(Gate::activeRoleIsAdmin($data["activeRole"])):?>
        All Transactions
    <?php else: ?>
        My Transactions
    <?php endif; ?>

</h1>


<?php if(Gate::activeRoleIsAdmin($data["activeRole"])):?>
    <div class="flex justify-center w-100 py-5" >
        <form class="w-2/5" method="get" action="<?php echo BASEURL . "/transaction"?>">
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
<?php endif;?>

<div class="flex w-full h-full justify-center">
    <?php if(isset($data["transactions"]) && count($data["transactions"]) > 0):?>
        <div class="overflow-x-auto">
            <table class="table rounded-lg" style="background-color: #2a303c">
                <thead class="rounded-lg" style="background-color: #2a303c">
                <tr style="background-color: #2a303c">
                    <th class="text-center" style="background-color: #2a303c">Buyer</th>
                    <th class="text-center" style="background-color: #2a303c">Product Name</th>
                    <th class="text-center" style="background-color: #2a303c">Quantity</th>
                    <th class="text-center" style="background-color: #2a303c">Total</th>
                    <th class="text-center" style="background-color: #2a303c">Created At</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data["transactions"] as $transaction):?>
                    <tr>
                        <td class="text-center">
                            <?php
                            echo htmlspecialchars($transaction["buyer"])?>
                        </td>
                        <td class="text-center">
                            <?php echo htmlspecialchars($transaction["product"]["productName"]) ?>
                        </td class="text-center">
                        <td class="text-center"><?php echo htmlspecialchars($transaction["quantity"])?></td>
                        <td class="text-center">
                            <?php echo "Rp. ".htmlspecialchars((int)$transaction["quantity"] * (int)$transaction["product"]["productPrice"])?>
                        </td>
                        <td class="text-center">
                            <?php $timestamp = $transaction["createdAt"];
                            $gmt_plus_7_timestamp = $timestamp + (7 * 3600);
                            echo htmlspecialchars(gmdate('r', $gmt_plus_7_timestamp));?>
                        </td>
                    </tr>

                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    <?php else:?>
        <h1 class="text-xl font-semibold">There is no transactions yet</h1>
    <?php endif;?>
</div>
