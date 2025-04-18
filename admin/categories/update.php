<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE categories SET name = '$name' WHERE category_id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: list.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
