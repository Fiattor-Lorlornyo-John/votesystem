<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location: admin/home.php');
  	}

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register / Sign-Up</title>
    <link rel="stylesheet" href="Register_Sign-Up_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

			<div class="container" id="signIn">
        <h1 class="form-title">SIGN-IN/LOGIN </h1>
    	<form action="login.php" method="POST">
					<div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" name="voter" id="voter" placeholder="Voter's ID" required maxlength="9">
                <label for="voter">Voter's ID</label>
            </div>
					<div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required minlength="8">
                <label for="password">Password</label>
            </div>
      		<div class="row">
    			<div class="col-xs-4">
          <input type="submit" class="btn" value="Sign In" name="login">			
					<!-- <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button> -->
        		</div>
      		</div>
    	</form>
			<!-- <p class="or">------------or------------</p> -->
			<div style="text-align: center; margin-top: 20px;">
				<img src="images/gmail.jpeg" alt="Gmail Logo" style="width:60px;height:50px; margin: 0 10px;">
				<img src="images/facebook.jpeg" alt="Facebook Logo" style="width:70px;height:50px; margin: 0 10px;">
    		<img src="images/Google.jpeg" alt="Google Logo" style="width:80px;height:50px; margin: 0 10px;">
			</div>
        <div class="link">
            <p>Already have an account? <a href="register.php">Sign Up</a></p>
        </div>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>