<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$keyword = $_GET['search'] ?? '';
$sql = "SELECT * FROM users WHERE username LIKE '%$keyword%' OR email LIKE '%$keyword%'";
$result = mysqli_query($conn, $sql);
?>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
    }

    h2 {
        text-align: center;
        color: #007BFF;
        margin-bottom: 20px;
    }

    form {
        text-align: center;
        margin-bottom: 20px;
    }

    input[type="text"] {
        padding: 8px 12px;
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-right: 10px;
    }

    button {
        padding: 8px 16px;
        background-color: #007BFF;
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    th,
    td {
        padding: 12px 15px;
        text-align: center;
    }

    th {
        background-color: #007BFF;
        color: white;
        text-transform: uppercase;
        font-size: 14px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #eaf4ff;
    }

    .action-link {
        padding: 6px 12px;
        margin: 0 5px;
        border-radius: 5px;
        color: white;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
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

    form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        border-radius: 50px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
    }

    input[type="text"] {
        padding: 12px 20px;
        font-size: 16px;
        border: 2px solid #007BFF;
        border-radius: 50px;
        width: 75%;
        outline: none;
        transition: all 0.3s ease;
        color: #333;
    }

    input[type="text"]:focus {
        border-color: #0056b3;
        box-shadow: 0 0 10px rgba(0, 91, 181, 0.4);
    }

    button {
        width: 160px;
        height: 46px;
        background-color: #007BFF;
        border: none;
        border-radius: 50px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin-left: 10px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<h2>👥 Quản lý người dùng</h2>

<form method="get" action="list.php">
    <input type="text" name="search" placeholder="Tìm theo tên hoặc email" value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit">🔍 Tìm kiếm</button>
</form>

<table>
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
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= ucfirst($row['role']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['user_id'] ?>" class="action-link edit">✏️ Sửa</a>
                <a href="delete.php?id=<?= $row['user_id'] ?>" class="action-link delete" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>