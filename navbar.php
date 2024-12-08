<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jwellary Bay</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
       

        /* Solid Navbar */
        .navbar {
            background-color: #343a40 !important; /* Dark background for contrast */
            position: relative;
            width: 100%;
            z-index: 10;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand text-light">Jwellary Bay</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left-aligned navigation links -->
            <ul class="navbar-nav me-auto"> 
                <li class="nav-item">
                    <a class="nav-link text-light" href="user_dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="product_list.php">Products</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-light" href="order_history.php">Orders</a>
                </li>
            </ul>
            <!-- Right-aligned logout link -->
            <ul class="navbar-nav ms-auto"> 
            <li class="nav-item">
                    <a class="nav-link text-light" href="cart.php"> MyCart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Script for navbar -->

</body>
</html>
