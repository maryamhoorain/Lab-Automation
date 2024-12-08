<?php
session_start();
include 'db.php';
include 'header.php'; 
// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    /* Body and Wrapper */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f6f9;
}

.wrapper {
  
    display: flex;
    height: 100vh;
}

/* Main Panel */
.main-panel {
    margin-left: 250px; /* Sidebar width */
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}


/* Dashboard Content */
.dashboard-container {
  margin-top:50px;
    padding-top: 20px;
    padding-left: 20px; /* To avoid content being behind sidebar */
}

/* Card Styling */
.card {
    border-radius: 8px;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #343a40;
    color: black;
    font-size: 18px;
    padding: 15px;
    text-align: center;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-body {
    padding: 20px;
    text-align: center;
}

.card-body h4 {
    font-size: 32px;
    color: #007bff;
}

/* Table Styling */
.table {
    width: 100%;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    text-align: center;
    padding: 12px;
}

.table th {
    background-color: #007bff;
    color: white;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tr:hover {
    background-color: #f1f1f1;
}



  </style>
</head>
<body>
<div class="wrapper">
      <!-- Sidebar -->
      <?php
        include 'sidebar.php'; 
      ?>

      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
          <!-- Topbar start -->
          <?php
            include 'topbar.php';   
          ?>
          <!-- End Topbar -->


<div class="dashboard-container">
    
    <!-- Main Content Area -->
    <div class="content">
        <h2>Welcome, Admin!</h2>
        
        <!-- Dashboard Cards (Placeholders for various admin stats) -->
        <div class="row">
            <!-- Card 1: Total Users -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Users
                    </div>
                    <div class="card-body">
                        <?php
                        // Fetch total number of users from the database
                        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users");
                        $data = mysqli_fetch_assoc($result);
                        echo "<h4>" . $data['total_users'] . "</h4>";
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- Card 2: Total Products -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Products
                    </div>
                    <div class="card-body">
                        <?php
                        // Fetch total number of products
                        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_products FROM products");
                        $data = mysqli_fetch_assoc($result);
                        echo "<h4>" . $data['total_products'] . "</h4>";
                        ?>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Orders -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Orders
                    </div>
                    <div class="card-body">
                        <?php
                        // Fetch total number of orders
                        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM orders");
                        $data = mysqli_fetch_assoc($result);
                        echo "<h4>" . $data['total_orders'] . "</h4>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Placeholder for further admin functionalities -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Recent Orders
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Email</th>
                                    <th>Total Price</th>
                                    <th>Shipping Address</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch recent orders (Limit to 5)
                                $query = "SELECT * FROM orders ORDER BY order_date DESC LIMIT 5";
                                $result = mysqli_query($conn, $query);
                                while ($order = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>{$order['id']}</td>
                                        <td>{$order['user_email']}</td>
                                        <td>\${$order['total_price']}</td>
                                        <td>{$order['shipping_address']}</td>
                                        <td>{$order['status']}</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>          
        <!-- Footer start -->
         <?php
            include 'footer.php';    
          ?>
        <!-- End Footer -->

      </div>
    
    </div>
    
    <!-- Script Start -->
          <?php
            include 'script.php';     
          ?>
    <!-- Script End -->
</body>
</html>

 