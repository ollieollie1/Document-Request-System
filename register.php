<?php
include 'db.php';

$student = $_POST['student-number'];
$password = $_POST['password'];

// Check if student already exists
$sql = "SELECT * FROM users WHERE student_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Student already registered
    header("Location: register.html?error=exists");
    exit();
}

// Hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$sql = "INSERT INTO users (student_number, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $student, $hashed);

if ($stmt->execute()) {
    // Registration success → return to login page
    header("Location: login.html?success=registered");
    exit();
} else {
    // Insert failed
    header("Location: register.html?error=failed");
    exit();
}

$stmt->close();
$conn->close();
?>