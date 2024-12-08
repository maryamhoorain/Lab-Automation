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
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include 'navbar.php';
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
