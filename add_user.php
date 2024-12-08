<?php
session_start();
include 'db.php';
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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


          <div class="add-product-container">
    <h2>Add New User</h2>
    <form action="add_user.php" method="post" enctype="multipart/form-data">
        
    <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
    <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
        
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>


<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $role = mysqli_real_escape_string($conn, $_POST['role']);

                // Securely hash the password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $query = "INSERT INTO users (name,email, password, role) VALUES ('$name','$email', '$hashed_password', '$role')";

                if (mysqli_query($conn, $query)) {
                    // Redirect after successful insertion
                    header('Location: all_users.php');
                    exit;
                } else {
                    echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
                } 
            }
            ?>


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
