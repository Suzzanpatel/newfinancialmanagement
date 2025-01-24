<?php
session_start(); // Start the session

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "fiscalpoint";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $date = $_POST['date'];
    $category = $_POST['category'];
    $item = $_POST['item'];
    $cost = $_POST['cost'];

    // Retrieve the user's ID from the session
    $user_id = $_SESSION['user_id'];

    // Insert the data into the "expense" table
    $sql = "INSERT INTO expense (UserID, Date, Category, Item, Amount) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssd", $user_id, $date, $category, $item, $cost);

    if ($stmt->execute()) {
        echo "<script>
            alert('Expense added successfully!');
            window.location.href = 'addexpense.php';
        </script>";
    } else {
        echo "<script>
            alert('Error adding expense: " . addslashes($stmt->error) . "');
            window.location.href = 'addexpense.php';
        </script>";
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
  <title>Add Expense</title>
  <link rel="stylesheet" href="addexpense.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="avatar"></div>
      <ul class="menu">
        <li>Name:</li>
        <br>
        <li><a href="landing.php">Home</a></li>
        <br>
        <li><a href="dashboard.php">Dashboard</a></li>
        <br>
        <li><a href="addexpense.php">Add Expense</a></li>
        <br>
        <li><a href="#">Expense Report</a></li>
        <br>
        <li><a href="#">Cost of Living Calculator</a></li>
        <br>
        <li><a href="#">Profile</a></li>
        <br>
        <li><a href="logout.php">Logout</a></li>
        <br>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-container">
      <h1>Add Expense:</h1>
      <form action="addexpense.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
        <option value="Housing">Housing</option>
        <option value="Food">Food</option>
        <option value="Transportation">Transportation</option>
        <option value="Healthcare">Healthcare</option>
        <option value="Education">Education</option>
        <option value="Entertainment">Entertainment</option>
        <option value="Personal Care">Personal Care</option>
        <option value="Debt Repayment">Debt Repayment</option>
        <option value="Savings & Investments">Savings & Investments</option>
        <option value="Insurance">Insurance</option>
        <option value="Childcare/Dependents">Childcare/Dependents</option>
        <option value="Gifts & Donations">Gifts & Donations</option>
        <option value="Miscellaneous">Miscellaneous</option>
    </select>

        <label for="item">Item:</label>
        <input type="text" id="item" name="item" required>

        <label for="cost">Cost of Item:</label>
        <input type="number" id="cost" name="cost" step="0.01" required>

        <button type="submit" class="add-expense-btn">Add Expense</button>
      </form>
    </div>
</div>
  </div>
</body>
</html>
