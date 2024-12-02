<?php include './head.php' ?>
   
    <div class=" app-theme-white body-tabs-shadow fixed-header">
        <?php 
           include '../class/dbh.php';
           include "../class/model/User.php";
           include "../class/controller/LoginController.php";
           include "../helpers/sanitize.php";
            if(isset($_POST['login_admin'])){
               $email = clean_input($_POST['email']);
               $password = $_POST['password'];
               $errors = [];
               if(empty($email)){
                    $errors['email'] = "<p class='text-danger'>Email field is required!</p>";
                }
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = "<p class='text-danger'>Provide a valid email address!</p>";
                }
                if(User::checkEmailNotExist($email) == true){
                    $errors['email'] = "<p class='text-danger'>Email does not exist!</p>";
                }
                if(empty($password)){
                    $errors['password'] = "<p class='text-danger'>Password field is required!</p>";
                }
                if(empty($errors)){
                       $userObject = new LoginController();
                       $userObject->logUser($email,$password);
                }

            }
        ?>
        <div class="app-main">
                <div class="app-main__outer">
                    <div class="app-main__innerr" style="padding: 50px 300px 0;flex: 1;">
                                   
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Login</h5>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Email</label>
                                            <input type="text" class="form-control" name="email">
                                             <p><?php echo isset($errors['email']) ? $errors['email'] : '' ?></p>
                                        </div>
                                      
                                       <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Password</label>
                                            <input type="password" class="form-control" name="password">
                                             <p><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-primary" type="submit" name="login_admin">Login</button>
                                </form>
            
                                
                            </div>
                        </div>
                       
                    </div>
                      
                </div>
        </div>
    </div>
<?php include './footer.php' ?>