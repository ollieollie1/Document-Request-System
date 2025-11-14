<?php
include 'db.php';

$student = $_POST['student-number'];
$password = $_POST['password'];
$confirm = $_POST['confirm-password'];

// Validate passwords match (extra backend safety)
if ($password !== $confirm) {
    header("Location: register.html?error=nomatch");
    exit();
}

// Check if student already exists
$sql = "SELECT * FROM users WHERE student_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Already registered
    header("Location: register.html?error=exists");
    exit();
}

// Hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$sql = "INSERT INTO users (student_number, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $student, $hashed);

if ($stmt->execute()) {
    // Success → go to login page
    header("Location: login.html?success=registered");
    exit();
} else {
    // Insert error
    header("Location: register.html?error=failed");
    exit();
}

$stmt->close();
$conn->close();
?>