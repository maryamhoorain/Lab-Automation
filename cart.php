<?php
session_start();
include 'db.php';
include 'header.php';


// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}


// Initialize the cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; 
}

// Add item to cart
if (isset($_GET['add'])) {
    $product_id = intval($_GET['add']);
    if (isset($_SESSION['cart'][$product_id])) {
        // If product is already in the cart, increase the quantity
        $_SESSION['cart'][$product_id]++;
        echo "<div class='alert alert-info'>Product quantity increased!</div>";
    } else {
        // If product is not in the cart, add it with quantity 1
        $_SESSION['cart'][$product_id] = 1;
        echo "<div class='alert alert-success'>Product added to cart!</div>";
    }
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $product_id = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        echo "<div class='alert alert-warning'>Product removed from cart!</div>";
    }
}

// Calculate total price
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Check if the product exists in the database
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
        if ($product = mysqli_fetch_assoc($result)) {
            $total += $product['price'] * $quantity; // Calculate total
        } else {
            // If the product is not found in the database, remove it from the cart
            unset($_SESSION['cart'][$product_id]);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Your Cart</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        // Check if the product exists in the database
                        $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
                        if ($product = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$product['name']}</td>
                                    <td>\${$product['price']}</td>
                                    <td>$quantity</td>
                                    <td><a href='cart.php?remove=$product_id' class='btn btn-danger'>Remove</a></td>
                                  </tr>";
                        } else {
                            // If the product is not found in the database, remove it from the cart
                            unset($_SESSION['cart'][$product_id]);
                        }
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Your cart is empty.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <h4>Total: $<?php echo number_format($total, 2); ?></h4>
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
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
