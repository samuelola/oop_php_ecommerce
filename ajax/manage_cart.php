<?php
// session_start();
include '../class/dbh.php';
include "../helpers/sanitize.php";
include "../helpers/delete_by_date_cart.php";
include "../class/model/Cart.php";
include "../class/controller/CartController.php";

if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
    
    $p_id = clean_input($_POST['p_id']);
    $qty = clean_input($_POST['qty']);
    $price = clean_input($_POST['price']);
    $user_id = clean_input($_POST['user_id']);
    $cartObject = new CartController();
    $basket = $cartObject->getUserCartId($user_id,$p_id);
    if($basket['count'] == 0){
       $cartObject->createCart($user_id,$p_id,$qty,$price);
    }else{
        $basket = $cartObject->getCartIdPro($user_id,$p_id);
        $new_prod_id = $basket['product_id'];
        $new_user_id = $basket['user_id'];
        $total_price = $qty * $price;
        $cartObject->createUpdateCart($new_prod_id,$qty,$total_price,$new_user_id);
    }
    $result = $cartObject->countCart($user_id);
    echo $result['theqty'];
       
}