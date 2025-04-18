<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$result = mysqli_query($conn, "SELECT * FROM brands");
?>

<h2>📋 Danh sách Thương hiệu</h2>
<a href="add.php">➕ Thêm thương hiệu mới</a><br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên thương hiệu</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['brand_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['brand_id'] ?>">✏️ Sửa</a> |
                <a href="delete.php?id=<?= $row['brand_id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>