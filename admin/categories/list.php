<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$result = mysqli_query($conn, "SELECT * FROM categories");
?>

<h2>Quản lý Danh mục</h2>
<a href="add.php">➕ Thêm danh mục</a><br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['category_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['category_id'] ?>">✏️ Sửa</a> |
                <a href="delete.php?id=<?= $row['category_id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>