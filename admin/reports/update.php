<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE reports SET status = '$status' WHERE report_id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: list.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
