<?php

class ProductController extends Product {

   public function regProduct($product_name,$category_name,$mrp,$price,$qty,$description,$img_name){
        $product = Product::addProduct($product_name,$category_name,$mrp,$price,$qty,$description,$img_name);
        return $product;
   }

   public function getProductId($id){
      
       $product = Product::getProdById($id);
       return $product;
   }

   
}