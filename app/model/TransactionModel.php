<?php
require "./app/model/Product.php";
class TransactionModel
{
    private $db;
    private $productModel;

    public function __construct(){
        $this->db = new Database();
        $this->productModel = new Product();
    }

    public function GetAllTransactions(){
        $transactions = $this->db->GetTransactions();
        foreach ($transactions as &$transaction){
            $transaction["product"] = $this->productModel->GetProductById($transaction["product"]);
        }
        return $transactions;
    }

    public function GetUserTransactions($username){
        $transactions = $this->GetAllTransactions();
        $userTransactions = [];
        foreach ($transactions as $transaction){
            if($transaction["buyer"] === $username){
                $userTransactions[] = $transaction;
            }
        }

        return $userTransactions;
    }

    public function filterUserTransactions($query){
        $transactions = $this->GetAllTransactions();
        $userTransactions = [];
        foreach ($transactions as $transaction){
            if(stripos($transaction["buyer"], $query) !== false){
                $userTransactions[] = $transaction;
            }
        }
        return $userTransactions;
    }


    public function AddTransaction($username, $quantity, $productID){
        $this->db->AddTransactions($username, $productID, $quantity);
    }
}