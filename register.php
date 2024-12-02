<?php
  if(isset($_POST['register'])){
      $name = clean_input($_POST['name']);
	  $email = clean_input($_POST['email']);
	  $password = $_POST['password'];
      $errors = [];
	  
	  if(empty($name)){
        $errors['name'] = "<p class='text-danger'>Name field is required!</p>";
      }
      if(!preg_match("/^[a-zA-Z\s]+$/",$name)){
         $errors['name'] = "<p class='text-danger'>Name field must contain only characters!</p>";
      }
	  if(empty($email)){
		$errors['email'] = "<p class='text-danger'>Email field is required!</p>";
	  }
	  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$errors['email'] = "<p class='text-danger'>Provide a valid email address!</p>";
	  }
	  if(User::checkEmailExist($email) == true){
          $errors['email'] = "<p class='text-danger'>Email Exist!</p>";
       }
       if(empty($password)){
          $errors['password'] = "<p class='text-danger'>Password field is required!</p>";
       } 
	   if(strlen($password) < 6){
          $errors['password'] = "<p class='text-danger'>Password must not be less than 6 character</p>";
       } 
	   if(empty($errors)){
			$userObject = new ShopRegisterController();
			$userObject->regShopUser($name,$email,$password);
		}
  }
  
?>

	<!-- Contact section -->
     <h2 style="text-align:center;margin-bottom: -40px;
    margin-top: 20px;
">Register</h2>
	<section class="contact-section">
        
		<div class="container">
			<div class="row">
                
                <div class="col-lg-2"></div>
				<div class="col-lg-8 contact-info">
					<form method="post" action="#" class="contact-form" style="margin-bottom:20px !important">
						<input type="text" placeholder="First Name" name="name" value="<?php echo isset ($name) ? $name : '' ?>">
						<p><?php echo isset($errors['name']) ? $errors['name'] : '' ?></p>
						<input type="email" placeholder="Your e-mail" name="email" value="<?php echo isset ($email) ? $email : '' ?>">
						<p><?php echo isset($errors['email']) ? $errors['email'] : '' ?></p>
						<input type="password" placeholder="Your Password" name="password">
						<p><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
						<button type="submit" name="register" class="site-btn">Register</button>
					</form>
					<p style="display:inline;">Already have an account ? <a href="index.php?login">Login Here</a> </p>
				</div>
                <div class="col-lg-2"></div>
			</div>
		</div>
		
	</section>
	


	