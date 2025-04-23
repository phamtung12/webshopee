<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$result = mysqli_query($conn, "SELECT * FROM brands");
?>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9;
    }

    h2 {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
    }

    a.add-brand {
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
        margin-bottom: 20px;
        font-weight: bold;
    }

    a.add-brand:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    }

    th,
    td {
        padding: 14px 16px;
        text-align: center;
        font-size: 15px;
    }

    th {
        background-color: #007bff;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #eef7ff;
    }

    a.action {
        text-decoration: none;
        font-weight: bold;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 14px;
        color: white;
    }

    a.edit {
        background-color: #ffc107;
    }

    a.edit:hover {
        background-color: #e0a800;
    }

    a.delete {
        background-color: #dc3545;
    }

    a.delete:hover {
        background-color: #c82333;
    }
</style>

<h2>📋 Danh sách Thương hiệu</h2>
<a href="add.php" class="add-brand">➕ Thêm thương hiệu mới</a>

<table>
    <tr>
        <th>ID</th>
        <th>Tên thương hiệu</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['brand_id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['brand_id'] ?>" class="action edit">✏️ Sửa</a>
                <a href="delete.php?id=<?= $row['brand_id'] ?>" class="action delete" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>


<?php include '../footer.php'; ?>