<?php
use Facade\Gate;
use Facade\Middleware;
use Facade\Preventor;
class Transaction extends Controller
{

    public function index(){
        Middleware::authenticatedOnly();

        $currUser = $_SESSION["USER"];
        $activeRole = $_SESSION["USER"]["roles"][0];
        if(isset($_SESSION["activeRole"])){
            $activeRole = $_SESSION["activeRole"];
        }
        $title = "My Transactions";
        $transactions = $this->model("TransactionModel")->GetUserTransactions($currUser["username"]);
        if(Gate::activeRoleIsAdmin($activeRole)){
            if(isset($_GET["search"])){
                $transactions = $this->model("TransactionModel")->filterUserTransactions($_GET["search"]);
            }else{
                $transactions = $this->model("TransactionModel")->GetAllTransactions();
            }
            $title = "All Transactions";
        }


        $this->view("Transaction/index", $title, [
            "currUser"=>$currUser,
            "activeRole"=>$activeRole,
            "transactions"=>$transactions
        ]);
    }

    public function create($id){
        Middleware::authenticatedOnly();
        if(Preventor::CSRFCheck($_REQUEST["csrf_token"])){
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
        }else{
            $_SESSION["error_message"] = "CSRF Token error";
            header("Location:". $_SERVER["HTTP_REFERER"]);
        }
    }



}