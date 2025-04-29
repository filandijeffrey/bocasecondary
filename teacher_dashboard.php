<?php
session_start();

// Check if the user is logged in and if the role is 'teacher'
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "teacher") {
    header("Location: login2.php"); // Redirect to login if not logged in or not a teacher
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "filandi");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch teacher's name from the database (assuming there's a 'users' table with 'name' column)
$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($name);
    $stmt->fetch();
} else {
    $name = "Teacher"; // Default if no name found
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
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

    <div class="container mt-5">
        <h2 style="color: white;" class="text-center">Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Manage Students</div>
                    <div class="card-body">
                        <p>View and manage student information.</p>
                        <a href="manage_students.php" class="btn btn-primary w-100">Manage Students</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Grade Management</div>
                    <div class="card-body">
                        <p>Enter and view student grades.</p>
                        <a href="grade_management.php" class="btn btn-primary w-100">Manage Grades</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Class Schedule</div>
                    <div class="card-body">
                        <p>View your class schedule and assignments.</p>
                        <a href="class_schedule.php" class="btn btn-primary w-100">View Schedule</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
	
	<!-- Include Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
