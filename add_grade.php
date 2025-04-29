<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $term = $_POST['term'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO grades (student_id, subject, term, grade) 
            VALUES ('$student_id', '$subject', '$term', '$grade')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Grade added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}

// Fetch students for dropdown
$students = $conn->query("SELECT id, first_name, last_name FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Grade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
 <?php include 'navbar2.php'; ?>

<!-- Centered Logo and Title -->
            <div class="navbar-brand-center text-center mx-auto">
                <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
                <div style="color: black;" class="school-title">Boca Secondary School</div>
            </div>

<div class="container mt-5">
    <h2 class="text-center">Add Grade</h2>
    <form method="POST" action="add_grade.php" class="border p-4 rounded shadow-sm">

        <div class="form-group">
            <label for="student_id">Student:</label>
            <select class="form-control" id="student_id" name="student_id" required>
                <option value="">-- Select Student --</option>
                <?php while ($row = $students->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['first_name'] . ' ' . $row['last_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <select class="form-control" id="subject" name="subject" required>
                <option value="">-- Select Subject --</option>
                <option value="Mathematics">Mathematics</option>
                <option value="English">English</option>
                <option value="Science">Science</option>
                <option value="History">History</option>
                <!-- Add more subjects as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="term">Term:</label>
            <select class="form-control" id="term" name="term" required>
                <option value="">-- Select Term --</option>
                <option value="Michaelmas">Michaelmas</option>
                <option value="Hilary">Hilary</option>
                <option value="Trinity">Trinity</option>
            </select>
        </div>

        <div class="form-group">
            <label for="grade">Grade:</label>
            <input type="text" class="form-control" name="grade" id="grade" required>
        </div>

        <button type="submit" class="btn btn-success">Add Grade</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
