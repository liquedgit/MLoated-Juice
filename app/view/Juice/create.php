<?php

use Facade\Gate;

require_once "../app/view/components/header.php";
require_once "../app/view/components/navbar.php";
?>

<!--<h1 class="text-center font-semibold text-4xl">Create New Juice</h1>-->
<div class="w-full h-full" style="background-color: #242933">
    <div class="container mx-auto mt-10 p-10">
        <h1 class="text-center font-semibold text-4xl">Create new Juice</h1>
        <div class="mt-8 flex justify-center">
            <div class="w-full md:w-1/2">
                <form
                      style="background-color: #2a303c" action="<?php
                echo htmlspecialchars(BASEURL . "/juice")
                ?>" method="POST" class="shadow-md rounded-lg px-8 pt-6 pb-8 mb-4"
                      enctype="multipart/form-data"
                >
                    <div class="form-control w-full mb-6">
                        <label class="label font-bold">
                            <span class="label-text">Juice name</span>
                        </label>
                        <input type="text"
                            <?php
                            if(isset($_SESSION["juiceName"])){
                                echo htmlspecialchars("value='".$_SESSION["juiceName"])."'";
                            }
                            ?>
                               name="juiceName" placeholder="Juice name" class="input input-bordered w-full max-w-xs" />
                        <label class="label">
                            <?php
                            if(isset($_SESSION["juice_name_error_message"])){
                                echo '
                                    <span class="label-text-alt text-red-500">'
                                    .htmlspecialchars("*".$_SESSION["juice_name_error_message"]).
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
                        <input type="number"
                            <?php
                            if(isset($_SESSION["juicePrice"])){
                                echo htmlspecialchars("value='".$_SESSION["juicePrice"])."'";
                            }
                            ?>
                               name="juicePrice" placeholder="Juice name" class="input input-bordered w-full max-w-xs" />
                        <label class="label">
                            <?php
                            if(isset($_SESSION["juice_price_error_message"])){
                                echo '
                                    <span class="label-text-alt text-red-500">'
                                    .htmlspecialchars("*".$_SESSION["juice_price_error_message"]).
                                    '</span>
                                 ';
                            }
                            ?>
                        </label>
                    </div>

                    <div class="form-control mb-6">
                        <label for="fileUpload" class="label font-bold">
                            <span class="label-text">Juice description</span>
                        </label>
                        <textarea id="fileUpload" name="juiceDescription"
                                  class="textarea textarea-bordered h-24" placeholder="Juice Description"><?php
                            if(isset($_SESSION["juiceDescription"]))
                                echo htmlspecialchars($_SESSION["juiceDescription"]);
                            ?></textarea>
                        <label class="label">
                            <?php
                            if(isset($_SESSION["juice_desc_error_message"])){
                                echo '
                                <span class="label-text-alt text-red-500">'
                                    .htmlspecialchars("*".$_SESSION["juice_desc_error_message"]).
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
                        <input type="file" id="fileUpload" name="fileUpload" accept="image/jpeg" class="hidden">
                        <label for="fileUpload" class="btn">
                            Choose File
                        </label>
                        <span id="selectedFileName" class="ml-2"></span>
                        <label class="label">
                        <span class="label-text-alt text-red-500 font-normal">
                            <?php
                            if(isset($_SESSION["juice_file_error_message"])){
                                echo htmlspecialchars("*".$_SESSION["juice_file_error_message"]);
                            }
                            ?>

                        </span>
                        </label>
                    </div>

                    <div class="flex w-full justify-center">
                        <button
                                class="btn btn-neutral btn-wide">
                            Create Juice
                        </button>
                    </div>
                </form>
            </div>
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
