<?php
$host = "localhost";
$user = "root";
$pass = "phamtung";
$dbname = "qlbh";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");
