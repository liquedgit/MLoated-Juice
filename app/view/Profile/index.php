<?php

use Facade\Gate;
require_once "../app/view/components/header.php";
require_once "../app/view/components/navbar.php";
?>

<div class="flex-col min-w-screen p-10 h-full">
    <div class="p-10 rounded-lg" style="background-color: #2a303c">
        <h1 class="text-xl font-semibold">Edit Profile</h1>
        <form class="justify-center my-5" id="formUpdateProfile" method="post"
              enctype="multipart/form-data"
              action="<?php echo BASEURL . "/profile/updateProfile"?>">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]?>"/>
            <div class="flex justify-center">
                    <div>
                        <div class="flex items-center mb-5">
                            <label for="username" class="font-medium text-md w-40">Username</label>
                            <input
                                value="<?php echo htmlspecialchars($data["currUser"]["username"])?>"
                                class="input input-bordered w-64" id="username" placeholder="Username" name="username" type="text"/>
                        </div>
                        <div class="flex items-center mb-5">
                            <label for="dob" class="font-medium text-md w-40">Date of birth</label>
                            <input
                                value="<?php echo htmlspecialchars($data["currUser"]["dob"])?>"
                                class="input input-bordered w-64" id="dob" placeholder="Dob" name="dob" type="date"/>
                        </div>
                        <div class="flex items-center">
                            <label for="username" class="font-medium text-md w-40">Gender</label>
                            <div class="flex justify-center">
                                <div class="px-2 pt-2">
                                    <input <?php if($data["currUser"]["gender"] === "male")echo "checked" ?> type="radio" name="gender" id="male" value="male">
                                    <label for="male" >Male</label>
                                </div>
                                <div class="px-2 pt-2">
                                    <input <?php if($data["currUser"]["gender"] === "female")echo "checked" ?> type="radio" name="gender" id="female" value="female">
                                    <label for="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center ml-10">
                        <div class="h-40 w-40 rounded-full overflow-hidden mr-10">
                            <img id="currentImage" class="w-full h-full object-cover" src="<?php echo $data["currUser"]["profileImagePath"] ?>"/>
                        </div>
                        <input type="file" id="fileUpload" name="fileUpload" accept="image/jpeg" class="hidden">
                        <label for="fileUpload" class="btn">
                            Choose File
                        </label>
                        <span id="selectedFileName" class="ml-2"></span>
                    </div>
                </div>
            <button id="updateProfileBtn" class="btn mt-10 w-full">Update profile</button>
        </form>
    </div>
<script>
    $("#fileUpload").on(("change"), e=>{
        console.log(e.target.files[0])
        $("#currentImage").attr('src', URL.createObjectURL(e.target.files[0]))
    })
    $("updateProfileBtn").on(("click"), e=>{
        e.preventDefault()
        $("#formUpdateProfile").submit()
    })
</script>

