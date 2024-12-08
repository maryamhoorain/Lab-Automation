<!-- Header start -->
<?php
  include 'header.php'; 

// Header end
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page
header('Location: login.php');
exit();
?>
  <!-- Script Start -->

  <?php
            include 'script.php';     
          ?>

    <!-- Script End -->
