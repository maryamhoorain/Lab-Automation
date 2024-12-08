<?php 
session_start();
include 'db.php';
include 'header.php'; 


// Check if a product ID is provided
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "<div class='alert alert-warning'>Product not found.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-warning'>No product ID provided.</div>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $average = mysqli_real_escape_string($conn, $_POST['average']);
    $benefits = mysqli_real_escape_string($conn, $_POST['benefits']);

    $update_query = "UPDATE products 
                     SET name = '$product_name', 
                         description = '$description', 
                         price = '$price', 
                         average = '$average', 
                         benefits = '$benefits' 
                     WHERE id = $product_id";

    // Check if a new image has been uploaded
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $target = "assets/img/" . basename($image);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Update query including the image
            $update_query = "UPDATE products 
                             SET name = '$product_name', 
                                 description = '$description', 
                                 price = '$price', 
                                 image = '$image', 
                                 average = '$average', 
                                 benefits = '$benefits' 
                             WHERE id = $product_id";
        } else {
            echo "<div class='alert alert-danger'>Error uploading the image.</div>";
            exit();
        }
    }

    if (mysqli_query($conn, $update_query)) {
        echo "<div class='alert alert-success'>Product updated successfully!</div>";
        header("Location: view_products.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error updating product: " . mysqli_error($conn) . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
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
        <h2>Update Product</h2>
        <form action="edit_product.php?id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" step="0.01" class="form-control" id="description" name="description" value="<?php echo $product['description']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="average" class="form-label">Average</label>
                <input type="text" step="0.01" class="form-control" id="average" name="average" value="<?php echo $product['average']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="benefits" class="form-label">Benefits</label>
                <input type="text" step="0.01" class="form-control" id="benefits" name="benefits" value="<?php echo $product['benefits']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image (optional)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
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
