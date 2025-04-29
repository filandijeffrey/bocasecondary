<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "filandi");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM students WHERE id = $id");
    header("Location: manage_students.php");
    exit();
}

// Fetch students
$result = $conn->query("SELECT id, first_name, last_name, email, form_level FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar2.php'; ?>

<!-- Centered Logo and Title -->
            <div class="navbar-brand-center text-center mx-auto">
                <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
                <div style="color: black;" class="school-title">Boca Secondary School</div>
            </div>
			
    <div class="container mt-5">
        <h2 class="text-center mb-4">Manage Students</h2>

        <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Form Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['form_level']; ?></td>
                        <td>
                            <a href="edit_student.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="manage_students.php?delete=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
