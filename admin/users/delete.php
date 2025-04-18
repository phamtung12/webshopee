<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    mysqli_query($conn, "DELETE FROM customers WHERE customer_id = $id");
    mysqli_query($conn, "DELETE FROM sellers WHERE seller_id = $id");
    mysqli_query($conn, "DELETE FROM users WHERE user_id = $id");
    header("Location: list.php");
    exit();
}
