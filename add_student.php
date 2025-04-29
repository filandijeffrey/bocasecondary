<?php
// Include the database connection file
include 'db_connect.php';

// Check if the user is logged in
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION["user_id"]);
$user_role = $_SESSION["user_role"] ?? null;

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

    // Parent information (either select or add a new parent)
    $parent_id = $_POST['parent_id'];
    $new_parent_name = $_POST['new_parent_name'] ?? null;
    $new_parent_email = $_POST['new_parent_email'] ?? null;
    $new_parent_phone = $_POST['new_parent_phone'] ?? null;
    $new_parent_address = $_POST['new_parent_address'] ?? null;

    // Insert student into the students table
    $sql = "INSERT INTO students (first_name, last_name, gender, date_of_birth, form_level, email, phone, address) 
            VALUES ('$first_name', '$last_name', '$gender', '$dob', '$form_level', '$email', '$phone', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        $student_id = $conn->insert_id; // Get the ID of the inserted student

        // If a new parent is added, insert into parents table
        if ($new_parent_name) {
            $parent_sql = "INSERT INTO parents (name, email, phone, address) 
                           VALUES ('$new_parent_name', '$new_parent_email', '$new_parent_phone', '$new_parent_address')";
            if ($conn->query($parent_sql) === TRUE) {
                $parent_id = $conn->insert_id; // Get the ID of the newly inserted parent
            }
        }

        // If an existing parent is selected, use the parent ID from the dropdown
        if ($parent_id) {
            // Associate the student with the selected or newly created parent
            $relation = "Parent"; // You can modify this if needed (e.g., 'Mother', 'Father')
            $student_parent_sql = "INSERT INTO student_parent (student_id, parent_id, relation) 
                                   VALUES ($student_id, $parent_id, '$relation')";
            $conn->query($student_parent_sql);
        }

        echo "<div class='alert alert-success text-center'>Student added successfully!</div>";
        echo "<div class='text-center'>
                <a href='manage_students.php' class='btn btn-primary me-2'>Manage Students</a>
                <a href='add_student.php' class='btn btn-success'>Add Another Student</a>
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch existing parents for the dropdown
$parent_query = "SELECT id, name FROM parents";
$parent_result = $conn->query($parent_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .form-scroll {
            max-height: 600px; /* Adjust the height as needed */
            overflow-y: auto;  /* Enables vertical scrolling */
        }
    </style>
</head>
<body>

    <?php include 'navbar2.php'; ?>

    <!-- Centered Logo and Title -->
    <div class="navbar-brand-center text-center mx-auto">
        <img src="BocaLogo.png" alt="School Logo" class="school-logo" />
        <div class="school-title">Boca Secondary School</div>
    </div>

    <!-- Form to Add Student -->
    <div class="container mt-5">
        <h2 class="text-center">Add New Student</h2>

        <!-- Scrollable Form Section -->
        <div class="form-scroll">
            <form action="add_student.php" method="POST" class="border p-4 rounded shadow-sm">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="form_level">Form Level:</label>
                        <input type="text" class="form-control" id="form_level" name="form_level" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Student's Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                </div>

                <h4>Select Existing Parent or Add New Parent:</h4>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="parent_id">Select Parent:</label>
                        <select class="form-control" name="parent_id" id="parent_id">
                            <option value="">-- Select Parent --</option>
                            <?php while ($parent = $parent_result->fetch_assoc()): ?>
                                <option value="<?php echo $parent['id']; ?>"><?php echo $parent['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <!-- Always show the option to add a new parent -->
                <div class="form-row">
                    <h4>Add New Parent (if not available):</h4>

                    <div class="col-md-12 mb-3">
                        <label for="new_parent_name">Parent Name:</label>
                        <input type="text" class="form-control" id="new_parent_name" name="new_parent_name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="new_parent_email">Parent Email:</label>
                        <input type="email" class="form-control" id="new_parent_email" name="new_parent_email">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="new_parent_phone">Parent Phone:</label>
                        <input type="text" class="form-control" id="new_parent_phone" name="new_parent_phone">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="new_parent_address">Parent Address:</label>
                        <textarea class="form-control" id="new_parent_address" name="new_parent_address"></textarea>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

	 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
