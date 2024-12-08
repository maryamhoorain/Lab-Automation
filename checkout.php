<?php
session_start();
include 'db.php';
include 'header.php';
include 'navbar.php'; 

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Check if cart is set and not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='alert alert-warning'>Your cart is empty. Please add products to the cart before proceeding.</div>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_SESSION['user'];
    $shipping_address = mysqli_real_escape_string($conn, $_POST['shipping_address']);
    $total_price = 0;

    // Loop through the cart to calculate total price
    foreach ($_SESSION['cart'] as $product_id) {
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
        if ($product = mysqli_fetch_assoc($result)) {
            $total_price += $product['price'];
        }
    }

    // Insert order into the database
    $query = "INSERT INTO orders (user_email, total_price, shipping_address) VALUES ('$user_email', '$total_price', '$shipping_address')";
    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);

        // Insert order details into the database
        foreach ($_SESSION['cart'] as $product_id) {
            mysqli_query($conn, "INSERT INTO order_details (order_id, product_id) VALUES ('$order_id', '$product_id')");
        }

        // Clear the cart after placing the order
        unset($_SESSION['cart']);
        echo "<div class='alert alert-success'>Order placed successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <h2>Checkout</h2>
        <form action="checkout.php" method="post">
            <div class="mb-3">
                <label for="shipping_address" class="form-label">Shipping Address</label>
                <textarea class="form-control" id="shipping_address" name="shipping_address" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
    
    <!-- Footer start -->
    <?php include 'footer.php'; ?>    
    <!-- End Footer -->

    <!-- Script Start -->
    <?php include 'script.php'; ?>     
    <!-- Script End -->

</body>
</html>
