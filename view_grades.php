<?php
include 'db_connect.php';
session_start();

// Fetch students and subjects for dropdowns
$students_result = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS name FROM students");
$subjects_result = $conn->query("SELECT DISTINCT subject FROM grades");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Grades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar2.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">View Grades</h2>
    <div class="alert alert-info text-center">No grades are shown until a selection is made or a new grade is added.</div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="filter_grades.php" method="GET" class="border p-4 rounded shadow-sm">
                <div class="form-group">
                    <label for="student_id">Select Student:</label>
                    <select class="form-control" name="student_id" id="student_id">
                        <option value="">-- Select Student --</option>
                        <?php while ($row = $students_result->fetch_assoc()): ?>
                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Select Subject:</label>
                    <select class="form-control" name="subject" id="subject">
                        <option value="">-- Select Subject --</option>
                        <?php while ($row = $subjects_result->fetch_assoc()): ?>
                            <option value="<?= $row['subject']; ?>"><?= $row['subject']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-2">View Grades</button>
            </form>

            <div class="d-flex justify-content-between mt-3">
                <a href="add_grade.php" class="btn btn-success">Add Grade</a>
                <a href="view_students.php" class="btn btn-info">View Student Info</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
