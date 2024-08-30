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
    <div class="container" id="signUp"> 
    <?php
    session_start();
    include 'includes/conn.php';

    if (isset($_POST['signUp'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $voters_id = $_POST['voters_id'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Verifying the unique voters_id
        $stmt = $conn->prepare("SELECT voters_id FROM voters WHERE voters_id = ?");
        $stmt->bind_param("s", $voters_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows != 0) {
            echo "<div class='message'>
                    <p>This Voters ID is already in use, try another one please!</p>
                  </div><br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        } else {
            $stmt = $conn->prepare("INSERT INTO voters (firstname, lastname, voters_id, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstname, $lastname, $voters_id, $password);
            if ($stmt->execute()) {
                echo "<div class='messages'>
                        <p>Registration successful!</p>
                      </div><br>";
                echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
            } else {
                echo "<div class='message'>
                        <p>Something went wrong. Please try again.</p>
                      </div><br>";
            }
        }

        $stmt->close();
    } else {
    ?>
        <h2 class="form-title">USER SIGN-UP</h2>
        <form action="" method="post">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname" required>
                <label for="firstname">Firstname</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lastname" id="lastname" placeholder="Lastname" required>
                <label for="lastname">Lastname</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" name="voters_id" id="voters_id" placeholder="Voters ID" required maxlength="9">
                <label for="voters_id">Voters ID</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required minlength="8">
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <!-- <p class="or">------------or------------</p> -->
        <div style="text-align: center; margin-top: 20px;">
				<img src="images/gmail.jpeg" alt="Gmail Logo" style="width:60px;height:50px; margin: 0 10px;">
				<img src="images/facebook.jpeg" alt="Facebook Logo" style="width:70px;height:50px; margin: 0 3px;">
    		<img src="images/Google.jpeg" alt="Google Logo" style="width:80px;height:50px; margin: 0 5px;">
			</div>
        <div class="link">
            <p>Already have an account? <a href="index.php">Sign In</a></p>
        </div>
    <?php
    }
    ?>
    </div>

    <script src="Register_Sign-Up_script.js"></script>
</body>
</html>
