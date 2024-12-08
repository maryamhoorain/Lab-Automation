<?php 
session_start();
include 'db.php';
include 'header.php'; 



if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "<div class='alert alert-warning'>User not found.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-warning'>No user ID provided.</div>";
    exit();
}

 // Handle form submission
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Only hash password if it is being updated
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $password_query = ", password = '$hashed_password'";
    } else {
        $password_query = "";
    }
    $update_query = "UPDATE users 
    SET name = '$name', 
        email = '$email', 
        role = '$role' 
        $password_query 
    WHERE id = $user_id";

if (mysqli_query($conn, $update_query)) {
echo "<div class='alert alert-success'>User updated successfully!</div>";
header("Location: all_users.php");
exit();
} else {
echo "<div class='alert alert-danger'>Error updating user: " . mysqli_error($conn) . "</div>";
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<style>
/* General container styling for Add/Edit Product Pages */
.product-form-container {
    background-color: #f8f9fa; /* Light background */
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Page heading for Add/Edit Product Pages */
.product-form-container h2 {
    font-size: 2rem;
    color: #343a40; /* Dark gray */
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
}

/* Form labels */
.product-form-container .form-label {
    font-weight: 600;
    color: #495057; /* Mid gray */
}

/* Form input fields */
.product-form-container .form-control {
    border-radius: 5px;
    border: 1px solid #ced4da;
    transition: all 0.3s;
}

.product-form-container .form-control:focus {
    border-color: #0d6efd; /* Bootstrap primary color */
    box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
}

/* File input styling */
.product-form-container #image {
    padding: 8px;
}

/* Submit button */
.product-form-container .btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-size: 1rem;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 5px;
    transition: all 0.3s;
}

.product-form-container .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

/* Alerts */
.alert {
    font-size: 0.95rem;
    margin-top: 20px;
}

/* Adjust margin for responsive design */
@media (max-width: 576px) {
    .product-form-container {
        padding: 20px;
    }

    .product-form-container h2 {
        font-size: 1.5rem;
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

          <div class="product-form-container">
        <h2>Update User</h2>
        <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="1" <?= $user['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                            <option value="2" <?= $user['role'] == 2 ? 'selected' : ''; ?>>User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
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
