<?php
// session_start();
include '../class/dbh.php';
include "../helpers/sanitize.php";
include "../helpers/delete_by_date_cart.php";
include "../class/model/Cart.php";
include "../class/controller/CartController.php";

if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
    
    $p_id = clean_input($_POST['prodId']);
    $user_id = clean_input($_POST['userId']);
    $total_price = clean_input($_POST['total']);
    $qty = clean_input($_POST['qty']);
    $cartObject = new CartController();
    $basket = $cartObject->createUpdateCart($p_id,$qty,$total_price,$user_id);
    if($basket){
        echo "Items updated in cart!";
    }else{
        echo "Items not updated in cart!";
    }
       
}