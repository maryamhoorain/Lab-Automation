<?php 
include 'db.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Transparent Navbar */
        .navbar {
            position: absolute;
            width: 100%;
            z-index: 10;
            background: rgba(255, 255, 255, 0.8); /* Slight white tint */
            backdrop-filter: blur(10px); /* Adds a blur effect to the navbar */
        }

        /* Styling for Container */
        .container {
            padding-top: 80px; /* Ensures navbar doesn't overlap */
        }

        /* Styling for Product Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Soft shadow */
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Card Hover Effect */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        /* Card Image */
        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            object-fit: cover;
        }

        /* Card Title and Text */
        .card-title {
            font-weight: bold;
            color: #333;
        }
        
        .card-text {
            font-size: 1.1rem;
            color: #666;
        }

        /* Button Style */
        .btn-primary {
            background-color: #4CAF50;
            border: none;
            transition: background-color 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    include 'navbar.php';
    ?>

<div class="container">
    <h2 class="text-center mb-4">Product List</h2>
    <div class="row">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='assets/img/{$row['image']}' class='card-img-top' alt='{$row['name']}' style='width: 100%; height: 200px; object-fit: cover;'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['name']}</h5>
                            <p class='card-text'>Price: \${$row['price']}</p>
                            <a href='cart.php?add={$row['id']}' class='btn btn-primary'>Add to Cart</a>
                        </div>
                    </div>
                  </div>";
        }
        ?>
    </div>
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
