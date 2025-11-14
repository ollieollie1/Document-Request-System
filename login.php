<?php
include 'db.php';
session_start();

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

        // Save login session
        $_SESSION['student_number'] = $row['student_number'];
        $_SESSION['fullname'] = $row['fullname']; // if you have it

        // Redirect to homepage
        header("Location: studenthomepage.html");
        exit();
    } else {
        header("Location: login.html?error=wrongpassword");
        exit();
    }
} else {
    header("Location: login.html?error=notfound");
    exit();
}

$stmt->close();
$conn->close();
?>