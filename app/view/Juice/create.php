<?php

use Facade\Gate;

require_once "../app/view/components/header.php";
require_once "../app/view/components/navbar.php";
?>

<!--<h1 class="text-center font-semibold text-4xl">Create New Juice</h1>-->

<div class="container mx-auto mt-10">
    <h1 class="text-center font-semibold text-4xl">Create new Juice</h1>
    <div class="mt-8 flex justify-center">
        <div class="w-full md:w-1/2">
            <form action="<?php
                echo htmlspecialchars(BASEURL . "/juice")
            ?>" method="POST" class="shadow-md rounded px-8 pt-6 pb-8 mb-4"
                  enctype="multipart/form-data"
            >
                <div class="form-control w-full mb-6">
                    <label class="label font-bold">
                        <span class="label-text">Juice name</span>
                    </label>
                    <input type="text" name="juiceName" placeholder="Juice name" class="input input-bordered w-full max-w-xs" />
                    <label class="label">
                        <?php
                            if(isset($_SESSION["juice_name_error_message"])){
                                echo '
                                    <span class="label-text-alt">'
                                        .htmlspecialchars($_SESSION["juice_name_error_message"]).
                                    '</span>
                                ';
                            }
                        ?>
                    </label>
                </div>
                <div class="form-control w-full mb-6">
                    <label class="label font-bold">
                        <span class="label-text">Juice Price</span>
                    </label>
                    <input type="number" name="juicePrice" placeholder="Juice name" class="input input-bordered w-full max-w-xs" />
                    <label class="label">
                        <?php
                            if(isset($_SESSION["juice_price_error_message"])){
                                echo '
                                    <span class="label-text-alt text-red-500">'
                                        .htmlspecialchars($_SESSION["juice_price_error_message"]).
                                    '</span>
                                 ';
                            }
                        ?>
                    </label>
                </div>

                <div class="form-control mb-6">
                    <label class="label font-bold">
                        <span class="label-text">Juice description</span>
                    </label>
                    <textarea name="juiceDescription" class="textarea textarea-bordered h-24" placeholder="Juice Description"></textarea>
                    <label class="label">
                        <?php
                        if(isset($_SESSION["juice_desc_error_message"])){
                            echo '
                                <span class="label-text-alt text-red-500">'
                                    .htmlspecialchars($_SESSION["juice_desc_error_message"]).
                                '</span>
                            ';
                        }
                        ?>
                    </label>
                </div>

                <div class="mb-6">
                    <label for="fileUpload" class="block text-sm font-bold mb-2">
                        Upload File
                    </label>
                    <input type="file" id="fileUpload" name="fileUpload" class="hidden">
                    <label for="fileUpload" class="btn">
                        Choose File
                    </label>
                    <span id="selectedFileName" class="ml-2">

                    </span>
                    <div>
                        <span class="text-red-500">
                            <?php
                                if(isset($_SESSION["juice_file_error_message"])){
                                    echo htmlspecialchars($_SESSION["juice_file_error_message"]);
                                }
                            ?>

                        </span>
                    </div>
                </div>

                <div class="flex w-full justify-center">
                    <button type="submit"
                            class="btn btn-neutral btn-wide">
                        Create Juice
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(()=>{
        $('#fileUpload').change((e)=>{
            // const fileName = $(this).val().split('\\').pop();
            const fileName = e.target.files[0].name
            $('#selectedFileName').text(fileName);

        })
    })
</script>
