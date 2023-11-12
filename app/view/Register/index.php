<?php
if(isset($_SESSION["error_message"])){
    echo '<div class="toast-notification" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                <div class="flex items-center bg-red-500 border-l-4 border-red-700 py-2 px-3 shadow-md mb-2" >
                    <!-- message -->
                    <div class="text-white max-w-xs ">'
        . $_SESSION["error_message"].
        '</div>
                </div>
              </div>';
}
?>

<div class="bg-gradient-to-r from-green-400 to-blue-500 flex justify-center items-center h-screen">
    <div class="relative shadow-2xl bg-white bg-opacity-70 backdrop-blur-md backdrop-saturate-150 rounded-xl py-8 flex flex-col justify-center items-align-center max-w-sm mt-10 border border-opacity-20 border-gray-300">
        <h2 class="text-2xl font-semibold mb-4 text-slate-500 text-center">Register</h2>
        <form class="flex flex-col relative" method="post" action="<?php echo BASEURL . '/register/auth';?>" >
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-80 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 mt-2 border border-opacity-20 border-gray-300
            focus:outline-none" name="username" type="text" placeholder="Username"/>
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-80 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 border border-opacity-20 border-gray-300
            focus:outline-none" type="password" name="password" placeholder="Password"/>
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-80 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 border border-opacity-20 border-gray-300
            focus:outline-none" type="password" name="confirmPassword" placeholder="Confirm Password"/>
            <label for="dob" class="text-slate-500 p-2 font-medium">Date of birth</label>
            <input class="bg-white bg-opacity-70 backdrop-blur-md w-80 backdrop-saturate-150 placeholder-gray-300 pl-2 py-2 border border-opacity-20 border-gray-300
            focus:outline-none" type="date" id="dob" name="DOB" placeholder="Date Of Birth"/>
            <div class="flex justify-center">
                <div class="px-2 pt-2">
                    <input type="radio" name="gender" id="male" value="male">
                    <label for="male">Male</label>
                </div>
                <div class="px-2 pt-2">
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female">Female</label>
                </div>
            </div>

            <button class="bg-white bg-opacity-70 h-full mt-2 h-full text-slate-500 p-2 font-medium">Register</button>
        </form>
        <a href="<?php echo BASEURL . "/register"; ?>" class="text-slate-500 flex justify-center mt-3 font-medium">Already have an account ? Log in here !</a>
    </div>
</div>