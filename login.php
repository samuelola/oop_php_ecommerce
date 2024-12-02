<?php
           if(isset($_POST['login'])){
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
                       $userObject = new ShopLoginController();
                       $userObject->logUser($email,$password);
                }

            }
?>
	<!-- Contact section -->
     <h2 style="text-align:center;margin-bottom: -40px;
    margin-top: 20px;
    ">Login</h2>
	<section class="contact-section">
        
		<div class="container">
			<div class="row">
                
                <div class="col-lg-2"></div>
				<div class="col-lg-8 contact-info">
					<form method="post" action="" class="contact-form" style="margin-bottom:20px !important">
						<input type="email" placeholder="Your e-mail" name="email" value="<?php echo isset ($email) ? $email : '' ?>">
						<p><?php echo isset($errors['email']) ? $errors['email'] : '' ?></p>
						<input type="password" placeholder="Your Password" name="password">
						<p><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
						<button type="submit" name="login" class="site-btn">Login</button>
					</form>
				</div>
                <div class="col-lg-2"></div>
			</div>
		</div>
		
	</section>
	


	