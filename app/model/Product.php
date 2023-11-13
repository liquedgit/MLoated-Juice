<?php

class Product
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function GetAllProducts(){
        return $this->db->GetProducts();
    }

    public function GetLatestProducts(){
        $products = $this->db->GetProducts();
        return array_slice($products,-5, 5, true);
    }

}