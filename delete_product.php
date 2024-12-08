<?php
session_start();
include 'db.php';

// Check if a product ID is provided
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    // Delete the product from the database
    $query = "DELETE FROM products WHERE id = $product_id";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Product deleted successfully!</div>";
        header('Location: view_products.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting product: " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>No product ID provided.</div>";
}
?>
