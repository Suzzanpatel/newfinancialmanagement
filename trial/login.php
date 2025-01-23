<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fiscalpoint');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the user's credentials from the database
    $sql = "SELECT Password FROM User WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['Password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            echo "Login successful! Welcome, $email.";
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with this email.";
    }
    $conn->close();
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="signup.css">
  <title>Fiscal Point</title>
</head>
<body>
  <div class="header">
    <nav>
        <br>
        <br>
        <!--Navigation Bar-->
      <a href="landing.html">Home</a> | 
      <a href="#">Expense Tracker</a> | 
      <a href="#">Cost of Living Calculator</a>
    </nav>
  </div>

  <main>
    <!--Login Form-->
  <div class="form-container">

    <h1>Welcome Back!</h1>
    
    <form action="login.php" method="post">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" class="login-button">Login</button>
      </form>
      <p class="signup-link">new user? <a href="signup.html">sign up instead</a></p>
    </div>
</main>
</body>