<?php
session_start();
include 'db.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_email = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Your Order History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Shipping Address</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM orders WHERE user_email = '$user_email' ORDER BY order_date DESC");
                if (mysqli_num_rows($result) > 0) {
                    while ($order = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$order['id']}</td>
                                <td>\${$order['total_price']}</td>
                                <td>{$order['shipping_address']}</td>
                                <td>{$order['status']}</td>
                                <td>{$order['order_date']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No orders found.</td></tr>";
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
