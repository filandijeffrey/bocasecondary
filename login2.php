<?php
session_start();
$error_message = ""; // Initialize the error message variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "filandi");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["role"] = $role; // Store the role in the session
            
            $stmt->close();
            $conn->close();
            
            // Redirect based on user role
            if ($role == 'teacher') {
                header("Location: teacher_dashboard.php"); // Redirect to teacher's dashboard
            } elseif ($role == 'student') {
                header("Location: student_dashboard.php"); // Redirect to student's dashboard
            } elseif ($role == 'parent') {
                header("Location: parent_dashboard.php"); // Redirect to parent's dashboard
            } else {
                $error_message = "Invalid user role.";
            }
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grading System</title>
    <link rel="stylesheet" href="styles2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <?php include 'navbar2.php'; ?>
	
	<!-- Centered Logo and Title -->
            <div class="navbar-brand-center text-center mx-auto">
                <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
                <div class="school-title">Boca Secondary School</div>
            </div>

    <div class="container text-center mt-5">
        <h2 style="color: white;">User Login</h2>

        <div class="login-form mx-auto mt-4" style="max-width: 400px; background: #fff; padding: 30px; border-radius: 10px;">
            <form action="login2.php" method="POST"> <!-- Change the action to the current file -->
                <div class="mb-3 text-start">
                    <label class="form-label" style="color: #333; font-weight: bold;">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label" style="color: #333; font-weight: bold;">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Display error message if any -->
                <?php if ($error_message): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <button type="submit" class="btn btn-success w-100">Login</button>
            </form>
        </div>
    </div>
	
	<!-- Include Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
