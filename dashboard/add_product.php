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

                                        Dashboard\Product
                                        <p style="display:inline; margin-left:50px"><a class="btn btn-sm btn-primary" href="index.php?all_product">All Product</a></p>
                                    </div>
                                </div>
                                  
                            </div>
                        </div> 
                        <?php 
                           include '../class/dbh.php';
                           include "../class/model/Category.php";
                           include "../class/model/Product.php";
                           include "../class/controller/CategoryController.php";
                           include "../class/controller/ProductController.php";
                           include "../helpers/sanitize.php";
                            $catObject = new CategoryController();
                            $all_categories = $catObject->getSingleCats();

                            if(isset($_POST['add_product'])){
                               $product_name = clean_input($_POST['product_name']);
                               $category_id = $_POST['category_id'];
                               $mrp = clean_input($_POST['mrp']);
                               $price = clean_input($_POST['price']);
                               $qty = clean_input($_POST['qty']);
                               $description = clean_input($_POST['description']);
                               $image = $_FILES['image'];
                               $img_name = $_FILES['image']['name'];
                               $img_temp = $_FILES['image']['tmp_name'];
                               $img_type = $_FILES['image']['type'];
                               $img_size = $_FILES['image']['size'];
                               function checkImageExtension(){
                                    global $img_name;
                                    $img_ext = explode('.',$img_name);
                                    $img_correct_extension = strtolower(end($img_ext));
                                    $allow = array('jpg','png','jpeg');
                                    if(in_array($img_correct_extension,$allow)){
                                       return true;
                                    }else{
                                       return false;
                                    }
                                }
                                function checkImageSize(){
                                    global $img_size;
                                    //5000 = 5kb
                                    if($img_size < 100000){
                                      return true;
                                    }else{
                                        return false;
                                    }
                                    
                                }
                               
                                $errors = [];
                                if(empty($product_name)){
                                    $errors['product_name'] = "<p class='text-danger'>Product Name field is required!</p>";
                                }
                                if(empty($category_id)){
                                    $errors['category_id'] = "<p class='text-danger'>Category field is required!</p>";
                                }
                                if(empty($mrp)){
                                    $errors['mrp'] = "<p class='text-danger'>MRP field is required!</p>";
                                }
                                if(empty($price)){
                                    $errors['price'] = "<p class='text-danger'>Price field is required!</p>";
                                }
                                if(empty($qty)){
                                    $errors['qty'] = "<p class='text-danger'>Qty field is required!</p>";
                                }
                                if(empty($description)){
                                    $errors['description'] = "<p class='text-danger'>Description field is required!</p>";
                                }
                                if(empty($image)){
                                    $errors['image'] = "<p class='text-danger'>Image field is required!</p>";
                                }
                                if(checkImageExtension () == false ){
                                    $errors['image'] = "<p class='text-danger'>The file extension is not allowed :( </p>";
                                }
                                if(checkImageSize () == false ){
                                    $errors['image'] = "<p class='text-danger'>File size too large :( </p>";
                                }
                                
                                if(empty($errors)){
                                    if(checkImageExtension () == true ){
                                         $path = "../img/product_images/$img_name";
                                         move_uploaded_file($img_temp,$path);
                                         $productObject = new ProductController();
                                         $add_product = $productObject->regProduct($product_name,$category_id,$mrp,$price,$qty,$description,$img_name);
                                         if($add_product){
                                            header("Location:./index.php?all_product");
                                         }
                                    }
                                   
                                    
                                }

                                

                                
                               
                            }
                        ?>    
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Product Form</h5>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Product name</label>
                                            <input type="text" class="form-control" name="product_name" value="<?php echo isset($product_name) ? $product_name : '' ?>">
                                            <p><?php echo isset($errors['product_name']) ? $errors['product_name'] : '' ?></p>
                                        </div>  
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Category</label>
                                            <select name="category_id" id="" class="form-control">
                                              <option value="">--select--</option>  
                                            <?php 
                                               foreach($all_categories as $all_category):
                                                ?>
                                                    <option value="<?php echo $all_category['id'] ?>"><?php echo $all_category['cat_name'] ?></option>
                                                <?php
                                               endforeach 
                                            ?>
                                            </select>
                                            <p><?php echo isset($errors['category_id']) ? $errors['category_id'] : '' ?></p>
                                        </div> 
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">MRP</label>
                                             <input type="number" class="form-control" name="mrp" value="<?php echo isset($mrp) ? $mrp : '' ?>">
                                             <p><?php echo isset($errors['mrp']) ? $errors['mrp'] : '' ?></p>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Price</label>
                                             <input type="number" class="form-control" name="price" value="<?php echo isset($price) ? $price : '' ?>">
                                             <p><?php echo isset($errors['price']) ? $errors['price'] : '' ?></p>
                                        </div> 
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Qty</label>
                                             <input type="number" class="form-control" name="qty" value="<?php echo isset($qty) ? $qty : '' ?>">
                                             <p><?php echo isset($errors['qty']) ? $errors['qty'] : '' ?></p>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Image</label>
                                             <input type="file" class="form-control" name="image" >
                                             <p><?php echo isset($errors['image']) ? $errors['image'] : '' ?></p>
                                        </div> 
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Description</label>
                                             <textarea name="description" id="" class="form-control" style="height: 114px;">
                                                 <?php echo isset($description) ? $description : '' ?>
                                             </textarea>
                                             <p><?php echo isset($errors['description']) ? $errors['description'] : '' ?></p>
                                        </div> 
                                    </div>
                                    
                                    <button class="btn btn-success" type="submit" name="add_product">Add Product</button>
                                </form>
                            </div>
                        </div>
                    </div>