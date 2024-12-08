<?php
session_start();
include 'db.php';

// Check if a product ID is provided
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    
    // Delete the product from the database
    $query = "DELETE FROM users WHERE id = $user_id";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>User deleted successfully!</div>";
        header('Location: all_users.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting user: " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>No user ID provided.</div>";
}
?>