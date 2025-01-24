<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Expenses</title>
    <link rel="stylesheet" href="allexpense.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
          <div class="avatar"></div>
          <ul class="menu">
            <li>Name:</li>
            <br>
            <li><a href="landing.html">Home</a></li>
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
    </div>
    <main>
    <div class="main-content">
      <h1>Category wise Expenses:</h1>
      <table>
        <thead>
          <tr>
            <th>Sr no.</th>
            <th>Date</th>
            <th>Category</th>
            <th>Item</th>
            <th>Cost of Item</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table rows will be dynamically added -->
        </tbody>
      </table>
    </div>
    </main>
  </body>
  </html>
