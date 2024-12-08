<?php 
include 'db.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <style>
        /* Container for the products table */
.details-container {
    background-color: #f8f9fa; /* Light background */
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

/* Page heading */
.details-container h2 {
    font-size: 2rem;
    color: #343a40; /* Dark gray */
    text-align: center;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Table styling */
.table {
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.table thead {
    background-color: #0d6efd; /* Bootstrap primary color */
    color: #fff;
}

.table thead th {
    font-weight: bold;
    text-align: center;
}

.table tbody td {
    vertical-align: middle;
    text-align: center;
    color: #495057; /* Darker gray */
    font-size: 0.95rem;
}

.table tbody img {
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    object-fit: cover;
}

/* Action buttons */
.btn-warning {
    color: #fff;
    font-weight: bold;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-danger {
    color: #fff;
    font-weight: bold;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* No products row styling */
.table tbody .text-center {
    color: #6c757d; /* Muted text color */
    font-style: italic;
}

/* Responsive design */
@media (max-width: 768px) {
    .view-products-container {
        padding: 20px;
    }

    .table tbody td img {
        width: 80px;
    }
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

    <div class="details-container">
        <h2>Orders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Email</th>
                    <th>Total Price</th>
                    <th>Shipping Address</th>
             
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM orders");
                while ($order = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$order['id']}</td>
                            <td>{$order['user_email']}</td>
                            <td>\${$order['total_price']}</td>
                            <td>{$order['shipping_address']}</td>
                            
                          </tr>";
                }
                ?>
            </tbody>
        </table>
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
