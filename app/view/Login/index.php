<?php
    if(isset($_SESSION["error_message"])){
        echo '<div class="toast-notification" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                <div class="flex items-center bg-red-500 border-l-4 border-red-700 py-2 px-3 shadow-md mb-2" >
                    <div class="text-white max-w-xs ">'
                        . $_SESSION["error_message"].
                    '</div>
                </div>
              </div>';
    }

?>

<div class="bg-gradient-to-r from-green-400 to-blue-500 flex justify-center items-center h-screen">
    <div class="relative shadow-2xl bg-white bg-opacity-70 backdrop-blur-md backdrop-saturate-150 rounded-xl py-8 flex flex-col justify-center items-align-center max-w-sm mt-10 border border-opacity-20 border-gray-300">
        <h2 class="text-2xl font-semibold mb-4 text-slate-500 text-center">Login</h2>
        <form class="flex flex-col relative" method="post" action="<?php echo BASEURL . '/login/authenticate';?>" >
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-72 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 mt-2 border border-opacity-20 border-gray-300
            focus:outline-none" name="username" type="text" placeholder="Username"/>
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-72 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 border border-opacity-20 border-gray-300
            focus:outline-none" type="password" name="password" placeholder="Password"/>
            <div class="self-start mt-2 ml-2 flex">
                <label for="rememberme" class="text-slate-500 align-text-top h-full" >Remember me</label>
                <input name="rememberme" id="rememberme" type="checkbox" class="ml-2">
            </div>

            <button class="bg-white bg-opacity-70 h-full mt-2 h-full text-slate-500 p-2 font-medium">Login</button>
        </form>
        <a href="<?php echo BASEURL . "/register"; ?>" class="text-slate-500 flex justify-center mt-3 font-medium">Don't have an account ? Sign up here !</a>
    </div>
</div>