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
    <title>Our Users</title>
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
    <h2>Users</h2>

<!-- Search Form -->
<form method="GET" action="">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search for users" aria-label="Search" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="btn btn-warning rounded mx-2" type="submit">Search</button>
    </div>
</form>

        <table class="table table-bordered">
            <thead>
                <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                        // Fetch users based on search
                        $sql = "SELECT * FROM users WHERE name LIKE '%$searchTerm%'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($user = mysqli_fetch_assoc($result)) {
                                $highlightedName = str_ireplace($searchTerm, "<span class='highlight'>$searchTerm</span>", $user['name']);
                                echo "<tr>
                                    <td>{$user['id']}</td>
                                     <td>{$highlightedName}</td>
                                    <td>{$user['email']}</td>
                                    <td>" . ($user['role'] == 1 ? 'Admin' : 'User') . "</td>
                                    <td>
                                        <a href='edit_user.php?id={$user['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='del_user.php?id={$user['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No users found.</td></tr>";
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
