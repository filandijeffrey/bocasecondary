<?php
include 'db_connect.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION["user_id"]);
$user_role = $_SESSION["user_role"] ?? null;

// Filter values
$filter_student = $_GET['filter_student'] ?? '';
$filter_subject = $_GET['filter_subject'] ?? '';
$filter_term = $_GET['filter_term'] ?? '';

// Build WHERE conditions
$where = [];
if (!empty($filter_student)) {
    $where[] = "grades.student_id = $filter_student";
}
if (!empty($filter_subject)) {
    $where[] = "grades.subject = '$filter_subject'";
}
if (!empty($filter_term)) {
    $where[] = "grades.term = '$filter_term'";
}
$where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

// Main query
$query = "
    SELECT grades.id, students.first_name, students.last_name, grades.subject, grades.grade, grades.term
    FROM grades 
    JOIN students ON grades.student_id = students.id
    $where_clause
    ORDER BY students.last_name
";
$result = $conn->query($query);

// Fetch for dropdowns
$students = $conn->query("SELECT id, first_name, last_name FROM students");
$subjects = $conn->query("SELECT DISTINCT subject FROM grades");
$terms = ['Michaelmas', 'Hilary', 'Trinity'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grade Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>
<body>
<?php include 'navbar2.php'; ?>

<!-- Centered Logo and Title -->
            <div class="navbar-brand-center text-center mx-auto">
                <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
                <div style="color: black;" class="school-title">Boca Secondary School</div>
            </div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Grade Management</h2>

    <div class="mb-3 text-end">
        <a href="add_grade.php" class="btn btn-success">Add New Grade</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="filter_student" class="form-select">
                <option value="">-- Filter by Student --</option>
                <?php while ($student = $students->fetch_assoc()): ?>
                    <option value="<?= $student['id'] ?>" <?= ($filter_student == $student['id']) ? 'selected' : '' ?>>
                        <?= $student['first_name'] . ' ' . $student['last_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-4">
            <select name="filter_subject" class="form-select">
                <option value="">-- Filter by Subject --</option>
                <?php while ($subject = $subjects->fetch_assoc()): ?>
                    <option value="<?= $subject['subject'] ?>" <?= ($filter_subject == $subject['subject']) ? 'selected' : '' ?>>
                        <?= $subject['subject'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="filter_term" class="form-select">
                <option value="">-- Filter by Term --</option>
                <?php foreach ($terms as $term): ?>
                    <option value="<?= $term ?>" <?= ($filter_term == $term) ? 'selected' : '' ?>>
                        <?= $term ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Grades Table -->
    <table id="gradesTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Grade</th>
                <th>Term</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                    <td><?= $row['subject'] ?></td>
                    <td><?= $row['grade'] ?></td>
                    <td><?= $row['term'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script>
    $(document).ready(function () {
        $('#gradesTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'print']
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
