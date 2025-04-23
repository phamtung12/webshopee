<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$result = mysqli_query($conn, "SELECT * FROM categories");
?>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f2f4f8;
    }

    h2 {
        text-align: center;
        color: #007BFF;
        font-size: 28px;
        margin-bottom: 20px;
    }

    a {
        text-decoration: none;
        font-weight: bold;
        color: #007BFF;
    }

    a:hover {
        text-decoration: underline;
    }

    .add-link {
        display: inline-block;
        margin-bottom: 20px;
        padding: 8px 16px;
        background-color: #28a745;
        color: white;
        border-radius: 6px;
        font-size: 14px;
    }

    .add-link:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    th,
    td {
        padding: 14px 18px;
        text-align: center;
    }

    th {
        background-color: #007BFF;
        color: white;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e9f5ff;
    }

    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: bold;
        color: white;
        margin: 0 5px;
        display: inline-block;
    }

    .edit {
        background-color: #ffc107;
    }

    .edit:hover {
        background-color: #e0a800;
    }

    .delete {
        background-color: #dc3545;
    }

    .delete:hover {
        background-color: #c82333;
    }
</style>

<h2>📂 Quản lý Danh mục</h2>
<a href="add.php" class="add-link">➕ Thêm danh mục</a>

<table>
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['category_id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['category_id'] ?>" class="action-btn edit">✏️ Sửa</a>
                <a href="delete.php?id=<?= $row['category_id'] ?>" class="action-btn delete" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>