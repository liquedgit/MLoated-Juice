<?php
    if(!isset($_COOKIE[USER_SESSION])){
        session_destroy();
        header("Location:" .BASEURL. "/login");
    }
?>
<div class="w-full px-4 flex items-center justify-between">
    <div class="h-32 overflow-hidden flex items-center">
        <img class="max-h-full max-w-full object-contain" src="../app/asset/img/logo.png">
        <h2 class="font-semibold text-2xl">MLoated Juice</h2>
    </div>
    <div class="w-36 h-full text-end">
        <?php if(in_array("Admin", $data["currUser"]["roles"])): ?>
            <form method="POST" action="<?php echo BASEURL . "/roles/activeRoles";?>" id="roleForm">
                <select name="option" class='w-full border-2 border-black rounded-md' id="roleSelect" >
                    <?php foreach ($data["currUser"]["roles"] as $role):?>
                        <option value="<?php echo htmlspecialchars($role);?>" <?php if($data["activeRole"] === $role) echo "selected"?>><?php echo htmlspecialchars($role);?></option>
                    <?php endforeach;?>
                </select>
            </form>
            <script>
                $(document).ready(function(){
                    $("#roleSelect").change(function (){
                        $("#roleForm").submit();
                    })
                })
            </script>
        <?php endif; ?>
        <h2 class="mt-3 font-semibold">Welcome, <?php echo htmlspecialchars($data["currUser"]["username"]);?></h2>
    </div>
</div>