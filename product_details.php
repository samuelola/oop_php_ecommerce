
<?php 
  if(isset($_GET['p_id'])){

	 $p_id = $_GET['p_id'];
     $prod = new ProductController();
     $get_prod_details = $prod->getProductId($p_id);

  }
  

?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Product Page</h4>
			<div class="site-pagination">
				<a href="#">Home</a> /
				<a href="#">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="index.php?product"> &lt;&lt; Back to Product</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="<?php echo "./img/product_images/".$get_prod_details['image'] ?>" alt="">
					</div>
					<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
							<div class="pt active" data-imgbigurl="<?php echo "./img/product_images/".$get_prod_details['image'] ?>">
								<img src="<?php echo "./img/product_images/".$get_prod_details['image'] ?>" alt="">
							</div>
							<div class="pt" data-imgbigurl="<?php echo "./img/product_images/".$get_prod_details['image'] ?>">
						</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title"><?php  echo isset($get_prod_details['product_name']) ? $get_prod_details['product_name'] : ''?></h2>
					<h3 class="p-price">&#8358;<?php echo isset($get_prod_details['price']) ? $get_prod_details['price'] : '' ?></h3>
					<h4 class="p-stock">Available: <span>In Stock</span></h4>
					<div class="p-rating">
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o fa-fade"></i>
					</div>
					<div class="p-review">
						<a href="#">3 reviews</a>|<a href="#">Add your review</a>
					</div>
					<div class="fw-size-choose">
						<p>Size</p>
						<!-- <div class="sc-item">
							<input type="radio" name="sc" id="xs-size">
							<label for="xs-size">32</label>
						</div>
						<div class="sc-item">
							<input type="radio" name="sc" id="s-size">
							<label for="s-size">34</label>
						</div>
						<div class="sc-item">
							<input type="radio" name="sc" id="m-size" checked="">
							<label for="m-size">36</label>
						</div>
						<div class="sc-item">
							<input type="radio" name="sc" id="l-size">
							<label for="l-size">38</label>
						</div>
						<div class="sc-item disable">
							<input type="radio" name="sc" id="xl-size" disabled>
							<label for="xl-size">40</label>
						</div> -->
						<!-- <div class="sc-item">
							<input type="radio" name="sc" id="xxl-size">
							<label for="xxl-size">42</label>
						</div> -->
					</div>
					<form>
					<div class="quantity">
						<p>Quantity</p>
                        <div class="pro-qty">
							<input type="text" min="1" id="qty" value="<?php echo $get_prod_details['qty'] ?>" >
							
					    </div>
						<input type="hidden" id="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>" >
						<input type="hidden" id="price" value="<?php echo $get_prod_details['price'] ?>" >
						<input type="hidden" id="prod_id" value="<?php echo $get_prod_details['p_id'] ?>" >
                    </div>
					<?php
					   
                         if(isset($_SESSION['user_id'])){
							$cartObject = new CartController();
                            $basket = $cartObject->getUserCartId($user_id,$p_id);
                            if($basket['count'] == 0){
                               ?><a href="#" id="addtocart" class="site-btn">Add To Cart</a><?php
							}else{
                               ?><a href="#" id="addtocart" class="site-btn">Update Cart</a><?php
							}
                            
						  }else{
							?><a href="index.php?login"  class="site-btn disabled">Update Cart</a><?php
						  }
					?>
					
			
					</form>
					   <?php
					      if(isset($_SESSION['user_id'])){
                            ?>
							
							   <a href="index.php?checkout&id=<?php echo $get_prod_details['p_id'] ?>"  style="display: inline-block;
    border: none;
    font-size: 14px;
    font-weight: 600;
    min-width: 167px;
    padding: 18px 47px 14px;
    border-radius: 50px;
    text-transform: uppercase;
    background: #6abf6a;
    color: #fff;
    line-height: normal;
    cursor: pointer;
    text-align: center;
	margin-top: 20px;
	">Proceed To Checkout</a>
							<?php
						  }else{
							?>
							  <a href="index.php?login"  style="display: inline-block;
    border: none;
    font-size: 14px;
    font-weight: 600;
    min-width: 167px;
    padding: 18px 47px 14px;
    border-radius: 50px;
    text-transform: uppercase;
    background: #6abf6a;
    color: #fff;
    line-height: normal;
    cursor: pointer;
    text-align: center;
	margin-top: 20px;
	">Proceed To Checkout</a>
							<?php
						  }
					   ?>
                    		
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>
										<?php echo $get_prod_details['product_name'] ?>
									</p>
									
								</div>
							</div>
						</div>
						<!-- <div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
									<img src="img/cards.png" alt="">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div> -->
						<!-- <div class="panel">
							<div class="panel-header" id="headingThree">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
							</div>
							<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="panel-body">
									<h4>7 Days Returns</h4>
									<p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div> -->
					</div>
					<!-- <div class="social-sharing">
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-youtube"></i></a>
					</div> -->
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->


	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>RELATED PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">
				<div class="product-item">
					<div class="pi-pic">
						<img src="img/product/1.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>$35,00</h6>
						<p>Flamboyant Pink Top </p>
					</div>
				</div>
				<div class="product-item">
					<div class="pi-pic">
						<div class="tag-new">New</div>
						<img src="img/product/2.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>$35,00</h6>
						<p>Black and White Stripes Dress</p>
					</div>
				</div>
				<div class="product-item">
					<div class="pi-pic">
						<img src="img/product/3.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>$35,00</h6>
						<p>Flamboyant Pink Top </p>
					</div>
				</div>
				<div class="product-item">
						<div class="pi-pic">
							<img src="img/product/4.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				<div class="product-item">
					<div class="pi-pic">
						<img src="img/product/6.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>$35,00</h6>
						<p>Flamboyant Pink Top </p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- RELATED PRODUCTS section end -->


	