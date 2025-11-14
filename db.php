<?php
$host = "sql12.freesqldatabase.com";
$user = "sql12807716";
$pass = "MNA7NgUV4q";
$db   = "sql12807716";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>