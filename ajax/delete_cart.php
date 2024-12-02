<?php
// session_start();
include '../class/dbh.php';
include "../helpers/sanitize.php";
include "../helpers/delete_by_date_cart.php";
include "../class/model/Cart.php";
include "../class/controller/CartController.php";

if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
    
    $prod_id = clean_input($_POST['prodId']);
    $user_id = clean_input($_POST['userId']);
    $cartObject = new CartController();
    $basket = $cartObject->deleteCartByUserCartId($user_id,$prod_id);
    if($basket){
        echo "Items deleted in cart!";
    }else{
        echo "Items not deleted in cart!";
    }
}