<!-- Header start -->
<?php
  include 'header.php'; 
?>
<!-- header end -->



<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
   
   
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="Signup.php" method="post">
        <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
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
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    
     <!-- Register link section -->
     <div class="login-link">
            <p>Already have an account? <a href="login.php">Please login</a></p>
        </div>

        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; // Capture the name from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Capture the selected role

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind email parameter
    $stmt->execute();
    $existingUser = $stmt->get_result()->fetch_assoc();

    if ($existingUser) {
        echo "<div class='alert alert-danger'>Error: Email already exists.</div>";
    } else {
        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare the insert statement to include the name field
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role); // Bind parameters for insert
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Registration successful</div>";
            header("Location: login.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
}
?>

    </div>
</body>
</html>

























  <!-- Script Start -->

  <?php
            include 'script.php';     
          ?>

    <!-- Script End -->
