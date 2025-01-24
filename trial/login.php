<?php
// Start the session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'fiscalpoint');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$errorMessage = ''; // To store error messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the user's credentials and UserID from the database
    $sql = "SELECT UserID, Password FROM User WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['Password'];
        $user_id = $row['UserID'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Set session variable for user ID
            $_SESSION['user_id'] = $user_id;

            // Redirect to dashboard.php
            header("Location: dashboard.php");
            exit();
        } else {
            $errorMessage = "Invalid password. Please try again.";
        }
    } else {
        $errorMessage = "No user found with this email.";
    }

    $stmt->close();
}
$conn->close();
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
      <p class="signup-link">new user? <a href="signup.php">sign up instead</a></p>
    </div>
</main>
</body>