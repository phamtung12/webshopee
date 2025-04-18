<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$keyword = $_GET['search'] ?? '';
$sql = "SELECT * FROM users WHERE username LIKE '%$keyword%' OR email LIKE '%$keyword%'";
$result = mysqli_query($conn, $sql);
?>

<h2>Quản lý người dùng</h2>

<form method="get" action="list.php">
    <input type="text" name="search" placeholder="Tìm theo tên hoặc email" value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit">🔍 Tìm kiếm</button>
</form>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên đăng nhập</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th>Vai trò</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['role'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['user_id'] ?>">✏️ Sửa</a> |
                <a href="delete.php?id=<?= $row['user_id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>