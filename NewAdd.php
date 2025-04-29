<?php
$conn = new mysqli("localhost", "root", "", "filandi");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = "FJeffrey";
$password = password_hash("Password1", PASSWORD_DEFAULT);
$roles = "teacher"

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Teacher account created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>