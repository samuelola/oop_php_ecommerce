<?php

class CartController extends Cart{
    
    // get all products by user
    public function getCartId($id){
       $basket = Cart::getCartById($id);
       return $basket;
    }

    public function getCartUserId($id){
       $basket = Cart::getItemsById($id);
       return $basket;
    }

    // get count all product by user id and product id
    public function getUserCartId($user_id,$p_id){
       $basket = Cart::getCartByUser($user_id,$p_id);
       return $basket;
    }

    public function getUserCartItemsId($user_id){
         $basket = Cart::getCartByIdd($user_id);
         return $basket;
        
    }

    // get all products by user id and product id
    public function getCartIdPro($user_id,$p_id){
        $basket = Cart::getCartByIdPro($user_id,$p_id);
        return $basket;
    }

    // create cart when empty by user
    public function createCart($user_id,$p_id,$qty,$price){
        $createthecart = Cart::addToCart($user_id,$p_id,$qty,$price);
        return $createthecart;
    }

    // update cart when user has cart items already
    public function createUpdateCart($p_id,$qty,$total_price,$user_id){
         $fufu = Cart::update($p_id,$qty,$total_price,$user_id);
         return $fufu;
    }

    // count all cart items by user
    public function countCart($user_id){
          
         $countcart = Cart::counterCart($user_id);
         return $countcart;
    }

    // get all products related with cart table
    public function getAllCartIdPro($user_id){
        $basket = Cart::getAlCartByIdPro($user_id);
        return $basket;
    }

    public function getAllItemsIdPro($user_id){
        $basket = Cart::getAlItemsByIdPro($user_id);
        return $basket;
    }

    public function deleteCartByUserCartId($user_id,$prod_id){
        $basket = Cart::deleteCartByuserCart($user_id,$prod_id);
        return $basket;
    }

    

    // delete all from a user cart after 1 day
    public function deleteAllCartByDate(){
        $result = Cart::deleteCartItems();
        return $result;
    }

    public function totalPricebyUser($user_id){
        $result = Cart::sumItems($user_id);
        return $result;
    }

    public function totalPricebyUserCart($user_id){
        $result = Cart::sumCartItems($user_id);
        return $result;
    }

    public function userReceipt($user_id){
        $result = Cart::userReceiptDetails($user_id);
        return $result;
    }
    
   
}