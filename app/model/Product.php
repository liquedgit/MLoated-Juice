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

    public function GetProductByName($productName): array
    {
        $products = $this->db->GetProducts();
        $arrNames = [];
        foreach ($products as $product){
            if(stripos($product["productName"], $productName) !== false){
                $arrNames[] = $product;
            }
        }
        return $arrNames;
    }

    public function GetProductById($productId){
        $products = $this->db->GetProducts();
        foreach ($products as $product){
            if($productId === $product["id"]){
                return $product;
            }
        }
        return null;
    }

    public function GetLatestProducts(){
        $products = $this->db->GetProducts();
        return array_slice($products,-5, 5, true);
    }

    public function AddNewProduct($juiceName, $juiceDesc, $juicePrice, $pathFile){
        $this->db->AddProducts($juiceName, $juicePrice, $juiceDesc, $pathFile);
    }

}