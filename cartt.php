
<?php 
  
  if(isset($_SESSION['user_id']) || isset($_SESSION['username'])){
      $user_id = $_SESSION['user_id'];
   
  }else{
    header("Location:./index.php?login");
  }

?>

	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="#">Home</a> /
				<a href="#">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
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
									
								 <table class="table table-striped">
									
										<thead>
											<th>Product</th>
											<th>Qty</th>
											<th>Unit Price</th>
											<th>Total Price</th>
										</thead>
									
									<tbody>
                                          <?php
										
										   foreach($rel as $val){
                                                ?>
												   <tr>
													 <td><?php echo $val['product_name'] ?></td>
													 <td>
														
														<input type="text" class="ok" value="<?php echo $val['qty'] ?>">
													</td>
													 <td>
														<input type="text" value="<?php echo $val['theprice'] ?>">
														
													</td>
													 <td><?php echo $val['price'] ?></td>
													 <td>
														
														<button class="btn btn-sm update_cart">+</button>
													 </td>
												   </tr>
											   <?php
											   
										   }
										   ?>   
									</tbody>
								 </table>


										
								<?php
							 }else{
                               ?><p>No Product in Cart</p><?php
							 }
                            
						    }
						   
						?>
						
					</div>
				</div>
				<div class="col-lg-4 card-right">
					
					<?php
					   
                         if(isset($_SESSION['user_id'])){
							
							 if($basket['count'] != 0){
                                ?><a href="index.php?checkout" class="site-btn">Proceed to checkout</a><?php
							 }else{

							 }
                            ?>
							
							<a href="index.php?product" class="site-btn sb-dark">Continue shopping</a>
							<?php
						  }
					?>
					
	
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->




	