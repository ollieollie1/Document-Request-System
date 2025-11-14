<?php
include 'db.php';

$student = $_POST['student-number'];
$password = $_POST['password'];

// Hash password for security
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (student_number, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $student, $hashed);

if ($stmt->execute()) {
    echo "<script>alert('Registration successful!'); window.location='login.html';</script>";
} else {
    echo "<script>alert('Error: Student number already exists or server error.'); window.location='register.html';</script>";
}

$stmt->close();
$conn->close();
?>