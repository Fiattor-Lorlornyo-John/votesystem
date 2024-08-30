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

if (isset($_POST['login'])) {
    $voter = $_POST['voter'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM voters WHERE voters_id = ?");
    $stmt->bind_param("s", $voter);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful and if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variable
            $_SESSION['voter'] = $row['id'];
            echo "<div class='messages'>
                    <p>Login successful!</p>
                  </div><br>";
            header('location: index.php');
            exit();
        } else {
            echo "<div class='message'>
                    <p>Incorrect password. Please try again.</p>
                  </div><br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        }
    } else {
        echo "<div class='messages'>
                <p>Cannot find voter with the ID</p>
              </div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close();
?>
<script src="Register_Sign-Up_script.js"></script>
</body>
</html>
