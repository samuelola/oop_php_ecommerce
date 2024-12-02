<?php include './includes/header.php' ?>

<?php 


if($_SERVER['REQUEST_URI'] == '/oop_ecommerce/index.php' || $_SERVER['REQUEST_URI'] == '/oop_ecommerce/'){
    include './home.php';
}

if(isset($_GET['cart'])){
        include './cart.php';
   }
   if(isset($_GET['checkout'])){
        include './checkout.php';
   }
   if(isset($_GET['category'])){
        include './category.php';
   }
   if(isset($_GET['contact'])){
        include './contact.php';
   }
   if(isset($_GET['product_details'])){
        include './product_details.php';
   }
   if(isset($_GET['product'])){
        include './product.php';
   }
   if(isset($_GET['register'])){
        include './register.php';
   }
   if(isset($_GET['login'])){
        include './login.php';
   }
   if(isset($_GET['receipt'])){
        include './receipt.php';
   }
   if(isset($_GET['check'])){
        include './check.php';
   }

?>
	

<?php include './includes/footer.php' ?>