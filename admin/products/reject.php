<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
$id = $_GET['id'];

$sql = "UPDATE products SET status='rejected' WHERE product_id = $id";
mysqli_query($conn, $sql);

header("Location: pending.php");
