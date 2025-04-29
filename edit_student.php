<?php
// Include the database connection file
include 'db_connect.php';

// Check if the user is logged in
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION["user_id"]);
$user_role = $_SESSION["user_role"] ?? null;

// Check if the student ID is passed in the URL
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch the student's current data
    $sql = "SELECT * FROM students WHERE id = $student_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit;
    }
} else {
    echo "Student ID is missing.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $form_level = $_POST['form_level'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update student data in the database
    $update_sql = "UPDATE students 
                   SET first_name = '$first_name', last_name = '$last_name', gender = '$gender', 
                       date_of_birth = '$dob', form_level = '$form_level', email = '$email', 
                       phone = '$phone', address = '$address' 
                   WHERE id = $student_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Student updated successfully!</div>";
        echo "<div class='text-center'>
                <a href='manage_students.php' class='btn btn-primary me-2'>Manage Students</a>
                <a href='edit_student.php?id=$student_id' class='btn btn-success'>Edit Another Student</a>
              </div>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include 'navbar2.php'; ?>

    <!-- Centered Logo and Title -->
    <div class="navbar-brand-center text-center mx-auto">
        <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
        <div class="school-title">Boca Secondary School</div>
    </div>

    <!-- Form to Edit Student -->
    <div class="container mt-5">
        <h2 class="text-center">Edit Student</h2>

        <form action="edit_student.php?id=<?php echo $student['id']; ?>" method="POST" class="border p-4 rounded shadow-sm">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" <?php echo ($student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($student['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $student['date_of_birth']; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="form_level">Form Level:</label>
                    <input type="text" class="form-control" id="form_level" name="form_level" value="<?php echo $student['form_level']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">Student's Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email']; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="phone">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $student['phone']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address"><?php echo $student['address']; ?></textarea>
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
