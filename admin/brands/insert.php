<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");

$name = $_POST['name'];
$sql = "INSERT INTO brands (name) VALUES ('$name')";

if (mysqli_query($conn, $sql)) {
    header("Location: list.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
