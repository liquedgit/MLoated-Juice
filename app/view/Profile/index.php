<?php

use Facade\Gate;
require_once "./app/view/components/header.php";
require_once "./app/view/components/navbar.php";
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
                                    disabled
                                value="<?php echo htmlspecialchars($data["currUser"]["username"])?>"
                                class="input input-bordered w-64" id="username" placeholder="Username" type="text"/>
                        </div>
                        <div class="flex items-center mb-5">
                            <label for="displayName" class="font-medium text-md w-40">Display Name</label>
                            <input
                                   value="<?php echo htmlspecialchars($data["currUser"]["displayName"])?>"
                                   class="input input-bordered w-64" id="displayName" placeholder="Display Name" type="text" name="displayName"/>
                        </div>
                        <div class="flex items-center mb-5">
                            <label for="bio" class="font-medium text-md w-40">Bio</label>
                            <textarea class="input input-bordered w-64 h-24" placeholder="Bio" id="bio" name="bio"><?php echo htmlspecialchars($data["currUser"]["bio"])?></textarea>

                        </div>
                        <div class="flex items-center mb-5">
                            <label for="dob" class="font-medium text-md w-40">Date of birth</label>
                            <input disabled
                                value="<?php echo htmlspecialchars($data["currUser"]["dob"])?>"
                                class="input input-bordered w-64" id="dob" placeholder="Dob" type="date"/>
                        </div>
                        <div class="flex items-center">
                            <label class="font-medium text-md w-40">Gender</label>
                                <?php echo htmlspecialchars($data["currUser"]["gender"]) ?>
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

