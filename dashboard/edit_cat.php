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

                                        Dashboard\Category
                                        
                                    </div>
                                </div>
                                  
                            </div>
                        </div> 
                        <?php
                           include '../class/dbh.php';
                           include "../class/model/Category.php";
                           include "../class/controller/CategoryController.php";
                           include "../helpers/sanitize.php";
                           $catObject = new CategoryController();
                           if(isset($_GET['edit_id'])){
                              $edit_cat_id  = $_GET['edit_id'];
                              $result = $catObject->getSingleCat($edit_cat_id);

                              if(isset($_POST['add_category'])){
                              $category = clean_input($_POST['category_name']);
                              $errors = [];
                              if(empty($category)){
                                $errors['category'] = "<p class='text-danger'>Category field is required!</p>";
                              }
                               if(empty($errors)){
                                    $update = $catObject->updateCat($category,$edit_cat_id);
                                    if($update){
                                      header("Location:./index.php?all_category");
                                    }
                                }
                             }
                           }
                           
                           
                        ?>           
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Category Form</h5>
                                <form method="post" action="">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Category name</label>
                                            <input type="text" class="form-control" name="category_name" value="<?php echo $result['cat_name'] ?>">
                                            <p><?php echo isset($errors['category']) ? $errors['category'] : '' ?></p>
                                        </div>   
                                    </div>
                                    
                                    <button class="btn btn-success" type="submit" name="add_category">Update Category</button>
                                </form>
                            </div>
                        </div>
                    </div>