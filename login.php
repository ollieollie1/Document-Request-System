<?php
include 'db.php';

$student = $_POST['student-number'];
$password = $_POST['password'];

// Fetch from database
$sql = "SELECT * FROM users WHERE student_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        echo "<script>alert('Login successful!'); window.location='studenthomepage.html';</script>";
    } else {
        echo "<script>alert('Incorrect password'); window.location='login.html';</script>";
    }
} else {
    echo "<script>alert('Student not found'); window.location='login.html';</script>";
}

$stmt->close();
$conn->close();
?>