<?php

class Productview extends Product{

    public function allProduct(){
        $get_all = Product::getAllProducts();
         return $get_all;
    }
}