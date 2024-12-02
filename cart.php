
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
									<div class="cart-table-warp">
									<table>
									<thead>
										<tr>
											<th class="product-th">Product</th>
											<th class="quy-th">Quantity</th>
											<th>Unit Price (&#8358;)</th>
											<th class="total-th">Total Price(&#8358;)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										   foreach($rel as $val){
											  $pro_id = $val['product_id'];
                                                ?>
												   <tr>
														<td class="product-col">
															<img src="<?php echo "./img/product_images/".$val['image'] ?>" alt="">
															<div class="pc-title">
																<h4><?php echo $val['product_name'] ?></h4>
																<!-- <p>&#8358;<?php echo $val['theprice'] ?></p> -->
															</div>
														</td>
														<td>
															<input style="width: 94px;
    height: 36px;
    border: 1px solid #ddd;
    padding: 0 15px;
    border-radius: 40px;
    float: left;
    text-align: center;"  type="text" class="cart_qty" id="cart_qty-<?php echo $pro_id ?>" pid="<?php echo $pro_id?>" value="<?php echo $val['qty'] ?>">
	 
																	
																	<input type="hidden" class="cart_user" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>">
														</td>
														<td >
                                                            <input style="width: 94px;
    height: 36px;
    border: 1px solid #ddd;
    padding: 0 15px;
    border-radius: 40px;
    float: left;
    text-align: center;" type="text" class="cart_price" id="cart_price-<?php echo $pro_id ?>" readonly  pid="<?php echo $pro_id?>" value="<?php echo round($val['theprice'],0) ?>">		
														</td>

														<td class="total-col">
													
                                                            <div class="quantity">
																<div>
																	<input style="width: 94px;
    height: 36px;
    border: 1px solid #ddd;
    padding: 0 15px;
    border-radius: 40px;
    float: left;
    text-align: center;" class="cart_total" id="cart_total-<?php echo $pro_id ?>" pid="<?php echo $pro_id ?>" type="text" value="<?php echo round($val['price'],0) ?>" readonly>
																</div>
										                    </div>	
															<!-- <h4 class="obtain">&#8358;<?php echo $val['price'] ?></h4> -->
														</td>
														<td>
															<button update_id = "<?php echo $pro_id ?>"  class="btn btn-sm btn-success update_cart">Update</button>
														</td>
														<td>
															<button delete_id = "<?php echo $pro_id ?>"  class="btn btn-sm btn-success delete_cart">Delete</button>
														</td>
													</tr>
												<?php
								            }
										?>

									</tbody>
										</table>
										</div>


										<div class="total-cost">
											<h6>Total <span>#
												<?php
												  $r = $cartObject->totalPricebyUser($user_id);
												  echo number_format($r['totalprice'],2);
												?>
											</span></h6>
										</div>
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




	