<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");


$id = $_POST['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$role = $_POST['role'];

$sql = "UPDATE users SET
            username = '$username',
            email = '$email',
            phone = '$phone',
            role = '$role'
        WHERE user_id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: list.php");
    exit();
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
