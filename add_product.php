<?php
ob_start();  // Start output buffering

if (headers_sent($file, $line)) {
    echo "Headers already sent in $file on line $line";
    exit; // Stops execution to debug
}


session_start();
include 'db.php';
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <style>
/* General container styling */
.add-product-container {
    background-color: #f8f9fa; /* Light background */
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Page heading */
.add-product-container h2 {
    font-size: 2rem;
    color: #343a40; /* Dark gray */
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
    margin-top: 50px;
    
}

/* Form labels */
.add-product-container .form-label {
    font-weight: 600;
    color: #495057; /* Mid gray */
}

/* Form input fields */
.add-product-container .form-control {
    border-radius: 5px;
    border: 1px solid #ced4da;
    transition: all 0.3s;
}

.add-product-container .form-control:focus {
    border-color: #0d6efd; /* Bootstrap primary color */
    box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
}

/* File input styling */
.add-product-container #image {
    padding: 8px;
}

/* Submit button */
.add-product-container .btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-size: 1rem;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 5px;
    transition: all 0.3s;
}

.add-product-container .btn-primary:hover {
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
    .add-product-container {
        padding: 20px;
    }

    .add-product-container h2 {
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


          <div class="add-product-container">
    <h2>Upload a New Product</h2>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="average" class="form-label">Average</label>
            <input type="text" class="form-control" id="average" name="average" required>
        </div>
        <div class="mb-3">
            <label for="benefits" class="form-label">Benefits</label>
            <input type="text" class="form-control" id="benefits" name="benefits" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $average = mysqli_real_escape_string($conn, $_POST['average']);
    $benefits = mysqli_real_escape_string($conn, $_POST['benefits']);

    $image = $_FILES['image']['name'];
    $target = "assets/img/" . basename($image);

    $query = "INSERT INTO products (name, description, price, image, average, benefits) VALUES ('$product_name', '$description', '$price', '$image', '$average', '$benefits')";
    if (mysqli_query($conn, $query)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            header('Location: view_products.php');
            exit; // Stop further execution
        }
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
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
