<?php 
session_start();
include './class/dbh.php';
include "./class/model/Billing.php";
include "./class/model/Cart.php";
include "./class/controller/BillingController.php";

if(isset($_GET['reference'])){
   $user_id = $_SESSION['user_id'] ;
   $reference = $_GET['reference'];
   $billingObject = new BillingController();
   $billingObject->verifyPayment($reference,$user_id);   
}

