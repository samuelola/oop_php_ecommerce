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
                           include "../class/view/CategoryView.php";
                        ?>           
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title">Table with hover</h5>
                                <?php 
                                    $cat_object = new CategoryController();
                                    if(isset($_POST['deactivate'])){
                                       $deactivate_status = $_POST['nonactive'];
                                       $cat_id = $_POST['cat_id'];
                                       $cat_object->deactivate($deactivate_status,$cat_id);
                                      
                                    }
                                    if(isset($_POST['activate'])){
                                       $activate_status = $_POST['the_active'];
                                       $cat_id = $_POST['cat_id'];
                                       $cat_object->activate($activate_status,$cat_id);
                                   
                                    }
                                    if(isset($_POST['delete_cat'])){
                                       $cat_id = $_POST['cat_id'];
                                       $cat_object->delete_cat($cat_id);

                                    }
                                    $categories= new Categoryview();
                                    $show_categories = $categories->getAllCategories();
                                ?>
                                <table class="mb-0 table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                           $sn = 1;
                                           foreach($show_categories as $show_category){
                                               ?>
                                                    <tr>
                                                        <td><?php echo $sn++ ?></td>
                                                        <td><?php echo $show_category['cat_name'] ?></td>
                                                        <td>
                                                            <?php
                                                              if($show_category['status'] == 1){
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
                                                            <?php
                                                              if($show_category['status'] == 1){
                                                                 ?>
                                                                  <form action="" method="post">
                                                                        <input type="hidden" name="cat_id" value="<?php echo $show_category['id'] ?>">
                                                                        <input type="hidden" name="nonactive" value="0">
                                                                        <button class="btn btn-success" name="deactivate">Deactivate</button>
                                                                        
                                                                  </form>
                                                                  
                                                                 <?php
                                                              }else{
                                                                  ?>
                                                                  <form action="" method="post">
                                                                        <input type="hidden" name="cat_id" value="<?php echo $show_category['id'] ?>">
                                                                        <input type="hidden" name="the_active" value="1">
                                                                        <button class="btn btn-danger" name="activate">Activate</button>
                                                                  </form>
                                                                  
                                                                 <?php
                                                              }
                                                         
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary" href="index.php?edit_cat&edit_id=<?php echo $show_category['id']; ?>">Edit</a> |
                                                            <form action="" method="post" style="display:inline">
                                                                <input type="hidden" name="cat_id" value="<?php echo $show_category['id']; ?>">
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