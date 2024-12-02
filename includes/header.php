<?php 
ob_start();
session_start();
include './class/dbh.php';
include "./class/model/User.php";
include "./class/model/Product.php";
include "./class/model/Cart.php";
include "./class/model/Billing.php";
include "./helpers/sanitize.php";
include "./class/view/ProductView.php";
include "./class/controller/ProductController.php";
include "./class/controller/CartController.php";
include "./helpers/delete_by_date_cart.php";
include "./class/controller/ShopRegisterController.php";
include "./class/controller/ShopLoginController.php";
include "./class/controller/BillingController.php";

//$cart_value = total_cart_value();
  del_cart_items();

?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from preview.colorlib.com/theme/divisima/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2024 22:50:48 GMT -->
<head>
	<title>Divisima | eCommerce Template</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<!-- <div id="preloder">
		<div class="loader"></div>
	</div> -->

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="index.php" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Search on divisima ....">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<?php 
								  
								   if(isset($_SESSION['user_id'])){
                                       ?><a href="shoplogout.php">Logout</a><?php
								   }else{
									  ?><a href="index.php?login">Sign In</a>  or <a href="index.php?register">Create Account</a><?php
								   }
								?>
								
							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<?php
									  if(isset($_SESSION['user_id'])){
										 $user_id = $_SESSION['user_id'];
										
										?>
										<span id="cart_counter">
											0
                                             <?php 
											    $cartObject = new CartController();
											    $result = $cartObject->countCart($user_id);
												echo $result['theqty'];
											  ?>
									    </span>
										<?php
									  }else{
										?>
										<span id="cart_counter">
                                             0 
									    </span>
										<?php
									  }
									  
									 ?>
								</div>
								<?php 
								   if(isset($_SESSION['user_id'])){
                                      ?><a href="index.php?cart">Shopping Cart</a><?php
								   }else{
									  ?><a href="index.php?register">Shopping Cart</a><?php
								   }
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="index.php?product">Product</a></li>
					<li><a href="index.php?category">Category</a></li>
					<li>
						<?php 
								  
							if(isset($_SESSION['user_id'])){
								?><a href="index.php?cart">Cart</a><?php
							}else{
								?><a href="index.php?register">Cart</a><?php
							}
						?>
						
					</li>
					<li>
						<?php 
								  
							if(isset($_SESSION['user_id'])){
								?><a href="index.php?checkout">Checkout</a><?php
							}else{
								?><a href="index.php?register">Checkout</a><?php
							}
						?>
					</li>
					<li><a href="index.php?contact">Contact</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->
