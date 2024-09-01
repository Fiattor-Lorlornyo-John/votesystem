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
    <div class="container" id="signUp"> 
<?php
session_start();
include 'includes/conn.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variable and redirect
            $_SESSION['admin'] = $row['id'];
            header('location: index.php');
            exit();
        } else {
            echo "<div class='messages'>
                    <p>Incorrect password. Please try again.</p>
                  </div><br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        }
    } else {
        echo "<div class='messages'>
                <p>Cannot find account with the username!</p>
              </div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    }

    $stmt->close();
}

$conn->close();
?>
    </div>
<script src="Register_Sign-Up_script.js"></script>
</body>
</html>
