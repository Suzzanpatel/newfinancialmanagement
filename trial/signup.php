<?php
// Step 1: Establish a database connection
$servername = "localhost";  // MySQL server (usually localhost)
$username = "root";         // MySQL username (usually 'root')
$password = "";             // MySQL password (usually empty for local setup)
$dbname = "fiscalpoint";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 3: Get the form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    // Step 4: Validate form data (you can add more validations as needed)
    if (empty($email) || empty($name) || empty($age) || empty($password)) {
        echo "All fields are required!";
        exit();
    }

    // Step 5: Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Step 6: Prepare the SQL query to insert data into the 'user' table
    $stmt = $conn->prepare("INSERT INTO user (email, name, age, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $email, $name, $age, $hashedPassword); // 's' = string, 'i' = integer

    // Step 7: Execute the query and check if the insertion is successful
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Step 8: Close the statement and connection
    $stmt->close();
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
      <a href="landing.html">Home</a> | 
      <a href="#">Expense Tracker</a> | 
      <a href="#">Cost of Living Calculator</a>
    </nav>
    
  </div>
  
  <div class="form-container">

    <h1>Welcome to Fiscal Point!</h1>
    <form method="POST" action="signup.php">
      <label for="email">Enter your email:</label>
      <input type="email" id="email" name="email" placeholder="Email">

      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" placeholder="Full Name">

      <label for="age">Age:</label>
      <input type="number" id="age" name="age" placeholder="Age">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Password">

      <button type="submit">Register</button>
    </form>
    <p>already a user? <a href="login.php">login instead</a></p>
  </div>
</body>
</html>
