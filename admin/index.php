
<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location:home.php');
  	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register / Sign-Up</title>
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container" id="signIn">
        <h1 class="form-title">Admin Login </h1>
    	<form action="login.php" method="POST">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="username" name="username" id="username" placeholder="Username" required>
                <label for="username">Username</label>
      		</div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required minlength="8">
                <label for="password">Password</label>
            </div>
            <div class="row">
    		<div class="col-xs-4">
            <input type="submit" class="btn" value="Sign In" name="login">
        	</div>
         </div>
    </form>
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
<?php include 'includes/scripts.php' ?>
</body>
</html>