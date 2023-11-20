<?php
use Facade\Gate;
class Transaction extends Controller
{

    public function index(){
        if(!isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/login");
        }

        $currUser = $_SESSION["USER"];
        $activeRole = $_SESSION["USER"]["roles"][0];
        if(isset($_SESSION["activeRole"])){
            $activeRole = $_SESSION["activeRole"];
        }
        $title = "My Transactions";
        $transactions = $this->model("TransactionModel")->GetUserTransactions($currUser["username"]);
        if(Gate::activeRoleIsAdmin($activeRole)){
            $transactions = $this->model("TransactionModel")->GetAllTransactions();
            $title = "All Transactions";
        }

        $this->view("Transaction/index", $title, [
            "currUser"=>$currUser,
            "activeRole"=>$activeRole,
            "transactions"=>$transactions
        ]);
    }

    public function create($id){
        if(!isset($_SESSION["USER"])){
            header("Location: " .BASEURL."/login");
        }

        unset($_SESSION["error_message"]);
        $qty = $_REQUEST["quantity"];
        if($qty === ""){
            $_SESSION["error_message"] = "Quantity cannot be empty";
            return;
        }
        elseif(!is_numeric($qty)){
            $_SESSION["error_message"] = "Quantity must be a numeric";
            return;
        }

        $user = $_SESSION["USER"];

        $this->model("TransactionModel")->AddTransaction($user["username"], (int)$qty, $id);
        $_SESSION["success_message"] = "Succesfully added transaction";
        header("Location:". $_SERVER["HTTP_REFERER"]);

    }

    function redirectBack(){
        header("Location :" . $_SERVER["HTTP_REFERER"]);
    }



}