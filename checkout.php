<?php 
  if(isset($_SESSION['user_id']) || isset($_SESSION['username'])){
      $user_id = $_SESSION['user_id'];
   
  }else{
    header("Location:./index.php?login");
  }

  if(isset($_POST['submit_orderr'])){
    
	  $address = clean_input($_POST['address']);
	  $phone = clean_input($_POST['phone']);
	  $user_id = $_POST['user_id'];
      $errors = [];
	  if(empty($address)){
        $errors['address'] = "<p class='text-danger'>Address field is required!</p>";
	  }
	  if(empty($phone)){
        $errors['phone'] = "<p class='text-danger'>Phone field is required!</p>";
	  }
	  if(!preg_match("/^[0-9\s]+$/",$phone)){
         $errors['phone'] = "<p class='text-danger'>Phone field must contain only digits!</p>";
      }
	  if(strlen($phone) < 11){
          $errors['phone'] = "<p class='text-danger'>Phone must not be less than 11 digits</p>";
      } 
	  if(empty($errors)){
			$billingObject = new BillingController();
			$cartObject = new CartController();
			$rel = $billingObject->billUser($address,$phone,$user_id);
			if($rel){
			  $r = $cartObject->totalPricebyUser($user_id);
			  $total_price = $r['totalprice'];
			  $userinfo = User::getUser($user_id);	
			  $email = $userinfo['email'];
			  $result = $billingObject->userPayment($address,$phone,$user_id,$email,$total_price);
			  if($result){
				// print_r($result);
                $reference = $result->data->reference;
				$authorization_url = $result->data->authorization_url;
				header("Location:$authorization_url");
			  }
			  
			  

			}
			

	   }
  }

?>


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your Checkout</h4>
			<div class="site-pagination">
				<a href="#">Home</a> /
				<a href="#">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form" method="post" action="">
						<div class="cf-title">Billing Address</div>
						<div class="row">
							<div class="col-md-7">
								<p>*Billing Information</p>
							</div>
							<!-- <div class="col-md-5">
								<div class="cf-radio-btns address-rb">
									<div class="cfr-item">
										<input type="radio" name="pm" id="one">
										<label for="one">Use my regular address</label>
									</div>
									<div class="cfr-item">
										<input type="radio" name="pm" id="two">
										<label for="two">Use a different address</label>
									</div>
								</div>
							</div> -->
						</div>
						<div class="row address-inputs">
							<input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>">
							<div class="col-md-12">
								<input type="text" placeholder="Address" name="address" value="<?php echo isset ($address) ? $address : '' ?>">
								<p><?php echo isset($errors['address']) ? $errors['address'] : '' ?></p>
							</div>
							
							<div class="col-md-6">
								<input type="text" placeholder="Phone no." name="phone" value="<?php echo isset ($phone) ? $phone : '' ?>">
								<p><?php echo isset($errors['phone']) ? $errors['phone'] : '' ?></p>
							</div>
						</div>
						<!-- <div class="cf-title">Delievery Info</div> -->
						<div class="row shipping-btns">
						
							
						</div>
						
						<button type="submit" name="submit_orderr" class="site-btn submit-order-btn">Place Order</button>
					</form>

					
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<?php 
						  $cartObject = new CartController();
						   if(isset($_SESSION['user_id'])){
							 $user_id = $_SESSION['user_id'];
							 $result = $cartObject->getCartId($user_id);
							 $p_id = isset($result['product_id']) ? $result['product_id'] : '';
							 $basket = $cartObject->getUserCartId($user_id,$p_id);
							 if($basket['count'] != 0){
								$rel = $cartObject->getAllCartIdPro($user_id);
								?>
								   <ul class="product-list">
							          <?php
									     foreach($rel as $val){
                                            ?>
											  <li>
													<div class="pl-thumb"><img src="<?php echo "./img/product_images/".$val['image'] ?>" alt=""></div>
													<h6><?php echo $val['product_name'] ?></h6>
													<p>&#8358;<?php echo $val['price'] ?></p>
											  </li>
											
											<?php

										 }
									 
									   ?>
										
									</ul>
									<ul class="price-list">
										<li>Total<span>&#8358;
											<?php
												  $r = $cartObject->totalPricebyUser($user_id);
												  echo number_format($r['totalprice'],2);
												?>
										</span></li>
										<li>Shipping<span>free</span></li>
										<li class="total">Total<span>&#8358;
											<?php
												  $r = $cartObject->totalPricebyUser($user_id);
												  echo number_format($r['totalprice'],2);
												?>
										</span></li>
									</ul>
								<?php
							 }else{

								?><p>No Product in Cart</p><?php
							 }

							}	
						?>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->

