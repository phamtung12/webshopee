<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE orders SET status = '$status' WHERE order_id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: list.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
