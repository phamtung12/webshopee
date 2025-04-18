<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM users WHERE user_id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<h2>Chỉnh sửa người dùng</h2>

<form method="post" action="update.php">
    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

    <label>Tên đăng nhập:</label><br>
    <input type="text" name="username" value="<?= $user['username'] ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>

    <label>Điện thoại:</label><br>
    <input type="text" name="phone" value="<?= $user['phone'] ?>"><br><br>

    <label>Vai trò:</label><br>
    <select name="role">
        <option value="customer" <?= $user['role'] === 'customer' ? 'selected' : '' ?>>Customer</option>
        <option value="seller" <?= $user['role'] === 'seller' ? 'selected' : '' ?>>Seller</option>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br><br>

    <button type="submit">💾 Cập nhật</button>
</form>

<?php include '../footer.php'; ?>