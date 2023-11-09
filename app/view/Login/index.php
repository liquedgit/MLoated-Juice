<?php
    if(!isset($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
?>
<div class="bg-gradient-to-r from-green-400 to-blue-500 flex justify-center items-center h-screen">
    <div class="relative shadow-2xl bg-white bg-opacity-50 backdrop-blur-md backdrop-saturate-150 rounded-xl py-8 flex flex-col justify-center items-align-center max-w-sm mt-10 border border-opacity-20 border-gray-300">
        <h2 class="text-2xl font-semibold mb-4 text-white text-center">Login</h2>
        <form class="flex flex-col relative" method="post" action="<?php echo BASEURL . '/login/authenticate';?>" >
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-72 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 mt-2 border border-opacity-20 border-gray-300
            focus:outline-none" name="username" type="text" placeholder="Username"/>
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-72 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 border border-opacity-20 border-gray-300
            focus:outline-none" type="text" name="password" placeholder="Password"/>
            <div class="self-start mt-2 ml-2 flex">
                <input type="checkbox">
                <p class="ml-2 text-white align-text-top h-full" >Remember me</p>
            </div>
            <button class="bg-white bg-opacity-70 h-full mt-2 h-full text-slate-500 p-2">Login</button>
        </form>
    </div>
</div>