


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Category PAge</h4>
			<div class="site-pagination">
				<a href="#">Home</a> /
				<a href="#">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->




	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2> PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">
				<?php 
				    $products= new Productview();
                    $show_products = $products->allProduct();
					foreach($show_products as $show_product){

                        ?>
						    <div class="product-item">
								<div class="pi-pic">
									<img style="width:190px;height:250px;" src="<?php echo "./img/product_images/".$show_product['image'] ?>" alt="">
									<div class="pi-links">
										<a href="index.php?product_details&p_id=<?php echo $show_product['p_id'] ?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div>
								</div>
								<div class="pi-text">
									<h6>&#8358;<?php echo $show_product['price'] ?></h6>
									<p><?php echo $show_product['product_name'] ?></p>
								</div>
							</div>
						<?php
					}
				?>
				
				
			</div>
		</div>
	</section>
	<!-- RELATED PRODUCTS section end -->

