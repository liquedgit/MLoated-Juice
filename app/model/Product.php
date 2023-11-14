<?php

class Product
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function GetProducts(){
        return $this->db->GetProducts();
    }

    public function GetProductsPaginated($limit, $offset){
        $products = $this->db->GetProducts();

        if(!isset($offset)){
            return array_slice($products, 0 ,$limit);

        }else{
            return array_slice($products, $offset, $limit);
        }
    }

    public function GetLatestProducts(){
        $products = $this->db->GetProducts();
        return array_slice($products,-5, 5, true);
    }

}