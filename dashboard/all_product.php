<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="fa fa-list"></i>
                                        </i>
                                    </div>
                                    <div>

                                        Dashboard\All Products
                                        <p style="display:inline; margin-left:50px"><a class="btn btn-sm btn-primary" href="index.php?add_product">Add Product</a></p>
                                    </div>
                                </div>
                                  
                            </div>
                        </div> 
                        <?php
                           include '../class/dbh.php';
                           include "../class/model/Product.php";
                           include "../helpers/sanitize.php";
                           include "../class/view/ProductView.php";
                        ?>           
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title">Table with hover</h5>
                                <?php 
                                   
                                    $products= new Productview();
                                    $show_products = $products->allProduct();
                                ?>
                                <table class="mb-0 table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Product Price</th>
                                        <th>Product Qty</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                           $sn = 1;
                                           foreach($show_products as $show_product){
                                               ?>
                                                    <tr>
                                                        <td><?php echo $sn++ ?></td>
                                                        <td>
                                                        <?php
                                                         ?><img src="<?php echo "../img/product_images/".$show_product['image'] ?>" alt="image" width="80" height="80"><?php 
                                                        
                                                        ?>
                                                        </td>
                                                        <td><?php echo $show_product['product_name'] ?></td>
                                                        <td><?php echo $show_product['cat_name'] ?></td>
                                                        <td><?php echo $show_product['price'] ?></td>
                                                        <td><?php echo $show_product['qty'] ?></td>
                                                        <td>
                                                            <?php
                                                              if($show_product['status'] == 1){
                                                                 ?>
                                                                  <span class="badge badge-success">Active</span>
                                                                 <?php
                                                              }else{
                                                                  ?>
                                                                    <span class="badge badge-danger">In Active</span>
                                                                  
                                                                 <?php
                                                              }
                                                         
                                                            ?>
                                                        </td>
                                                        
                                                        <td>
                                                            <a class="btn btn-sm btn-primary" href="index.php?edit_cat&edit_id=<?php echo $show_product['p_id']; ?>">Edit</a> |
                                                            <form action="" method="post" style="display:inline">
                                                                <input type="hidden" name="cat_id" value="<?php echo $show_product['p_id']; ?>">
                                                                <input type="submit" name="delete_cat" class="btn btn-sm btn-danger" value="Delete">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>