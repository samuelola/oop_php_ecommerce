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
			<h4>Your Receipt</h4>
			<div class="site-pagination">
				<a href="#">Home</a> /
				<a href="#">Your receipt</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
            <?php
                $cartObject = new CartController();
                if(isset($_SESSION['user_id'])){
                    $user_id = $_SESSION['user_id'];
                    $result = $cartObject->getCartId($user_id);
                    $p_id = isset($result['product_id']) ? $result['product_id'] : '';
                    $basket = $cartObject->getUserCartId($user_id,$p_id);
                    if($basket['count'] != 0){
						$rel = $cartObject->getAllCartIdPro($user_id);
                        $user_details = $cartObject->userReceipt($user_id);
                        $user_billing = Cart::userReceiptDetailss($user_id);
                    
                        ?>
                <div class="row">
                <div class="col-md-6">
                   <h4>TechSolve</h4>
                   <p>East London</p>
                </div>
                <div class="col-md-6">
                    <h4>Receipt</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                   <h5>Bill To:</h5>
                   <p><?php echo isset($user_details['name']) ? $user_details['name'] : ''; ?></p>
                   <p><?php echo isset($user_billing['address']) ? $user_billing['address'] : '' ?></p>
                </div>
                <div class="col-lg-3">
                   <h5>Ship To:</h5>
                   <p><?php echo isset($user_details['name']) ? $user_details['name'] : '' ; ?></p>
                   <p><?php echo isset($user_billing['address']) ? $user_billing['address'] : '' ?></p> 
                </div>
                <div class="col-lg-3">
                    <h5></h5>
                    <p>Receipt No:</p>
                    <p>Receipt Date:</p>
                </div>
                <div class="col-lg-3">
                    <h5></h5>
                    <p><?php echo isset($user_details['reference']) ? $user_details['reference'] : ''; ?></p>
                    <p><?php echo isset($user_details['created_at']) ? $user_details['created_at'] : ''; ?></p>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">
						<table class="table table-bordered table-condensed table-responsive table-striped">
							<thead>
								<tr>
									<th class="product-th">Qty</th>
									<th class="quy-th">Description</th>
									<th class="size-th">Unit Price (&#8358)</th>
									<th class="total-th">Amount(&#8358)</th>
								</tr>
							</thead>
							<tbody>
                                <?php
										
									foreach($rel as $val){
                                        ?>

                                        <tr>
                                            <td>1</td>
                                            <td><?php echo isset($val['product_name']) ? $val['product_name'] : '' ?></td>
                                            <td>56</td>
                                            <td>344</td>
                                        </tr>
                                        
                                        <?php
                                    }
                                ?>           
								
                               
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Subtotal</td>
                                    <td>
                                        <?php
                                            $r = $cartObject->totalPricebyUser($user_id);
                                            echo number_format($r['totalprice'],2);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Shipping</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        Total
                                    </td>
                                    <td>
                                        <?php
                                            $r = $cartObject->totalPricebyUser($user_id);
                                            echo number_format($r['totalprice'],2);
                                        ?>
                                    </td>
                                </tr>
							</tbody>
						</table>
						
                            </div>
                            
                        </div>
                        <?php
                    }            
                }else{
                    ?><p>No receipt</p><?php
                }
                

            ?>                 
            
		</div>
	</section>
	<!-- cart section end -->

	