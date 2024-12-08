<?php
session_start();
include 'db.php';
include 'header.php'; 


// initialize the search term
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        /* Container for the products table */
.view-products-container {
    background-color: #f8f9fa; /* Light background */
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

/* Page heading */
.view-products-container h2 {
    font-size: 2rem;
    color: #343a40; /* Dark gray */
    text-align: center;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Table styling */
.table {
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.table thead {
    background-color: #0d6efd; /* Bootstrap primary color */
    color: #fff;
}

.table thead th {
    font-weight: bold;
    text-align: center;
}

.table tbody td {
    vertical-align: middle;
    text-align: center;
    color: #495057; /* Darker gray */
    font-size: 0.95rem;
}

.table tbody img {
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    object-fit: cover;
}

/* Action buttons */
.btn-warning {
    color: #fff;
    font-weight: bold;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-danger {
    color: #fff;
    font-weight: bold;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* No products row styling */
.table tbody .text-center {
    color: #6c757d; /* Muted text color */
    font-style: italic;
}

/* Responsive design */
@media (max-width: 768px) {
    .view-products-container {
        padding: 20px;
    }

    .table tbody td img {
        width: 80px;
    }
}
.highlight {
    background-color: yellow; /* Highlight search term */
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
    <div class="view-products-container">
        <h2>Our Products</h2>
        
        <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search for products" aria-label="Product name" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-warning rounded mx-2" type="submit">Search</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Average</th>
                    <th>Benefits</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch products based on search
$sql = "SELECT * FROM products WHERE name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($product = mysqli_fetch_assoc($result)) {
        $highlightedName = str_ireplace($searchTerm, "<span class='highlight'>$searchTerm</span>", $product['name']);
        echo "<tr>
                <td>{$product['id']}</td>
                <td>{$highlightedName}</td>
                <td>{$product['description']}</td>
                <td>\${$product['price']}</td>
                <td><img src='assets/img/{$product['image']}' alt='{$product['name']}' style='width: 100px;'></td>
                <td>{$product['average']}</td>
                <td>{$product['benefits']}</td>
                <td>
                    <a href='edit_product.php?id={$product['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete_product.php?id={$product['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No products found.</td></tr>";
}

                ?>
            </tbody>
        </table>
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
