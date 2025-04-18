<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
$id = $_GET['id'];
$sql = "DELETE FROM categories WHERE category_id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: list.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
