<?php include './header.php' ?>   
                    <!--sidebar-->
                    <?php include './sidebar.php' ?>
                    
                    <?php
                      $url = '/oop_ecommerce';          
                      if($_SERVER['REQUEST_URI'] == "$url/dashboard/index.php" || $_SERVER['REQUEST_URI'] == '/oop_ecommerce/dashboard') {
                            include './home.php';
                      }
                      if(isset($_GET['add_category'])){
                         include './add_category.php';
                      }
                      if(isset($_GET['all_category'])){
                         include './all_category.php';
                      }
                      if(isset($_GET['edit_cat'])){
                         include './edit_cat.php';
                      }
                      if(isset($_GET['add_product'])){
                         include './add_product.php';
                      }
                      if(isset($_GET['all_product'])){
                         include './all_product.php';
                      }
                      
                    ?>
                    
                    <!--footer-->   
<?php include './footer.php' ?>
