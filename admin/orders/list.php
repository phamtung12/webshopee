<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$sql = "SELECT o.*, u.username
        FROM orders o
        JOIN customers c ON o.customer_id = c.customer_id
        JOIN users u ON c.customer_id = u.user_id
        ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $sql);
?>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9;
    }

    h2 {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
        font-size: 26px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    th,
    td {
        padding: 14px 18px;
        text-align: center;
        font-size: 15px;
    }

    th {
        background-color: #007BFF;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #eaf7ff;
        transition: background-color 0.3s ease;
    }

    a {
        text-decoration: none;
        margin: 0 5px;
        color: #007BFF;
        font-weight: 600;
        transition: color 0.3s;
    }

    a:hover {
        text-decoration: underline;
        color: #0056b3;
    }

    .status {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: bold;
        display: inline-block;
        min-width: 80px;
    }

    .status.pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status.shipped {
        background-color: #d4edda;
        color: #155724;
    }

    .status.cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>


<h2>📦 Danh sách đơn hàng</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Khách hàng</th>
        <th>Ngày đặt</th>
        <th>Trạng thái</th>
        <th>Tổng tiền</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['order_id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= $row['order_date'] ?></td>
            <td>
                <span class="status <?= strtolower($row['status']) ?>">
                    <?= ucfirst($row['status']) ?>
                </span>
            </td>
            <td><?= number_format($row['total_price'], 0, ',', '.') ?> đ</td>
            <td>
                <a href="detail.php?id=<?= $row['order_id'] ?>">🔍 Chi tiết</a>
                <a href="update_status.php?id=<?= $row['order_id'] ?>&status=shipped">🚚 Giao</a>
                <a href="update_status.php?id=<?= $row['order_id'] ?>&status=cancelled">❌ Huỷ</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>