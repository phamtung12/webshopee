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

<h2>📦 Danh sách đơn hàng</h2>

<table border="1" cellpadding="5" cellspacing="0">
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
            <td><?= $row['username'] ?></td>
            <td><?= $row['order_date'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
            <td><?= number_format($row['total_price'], 0, ',', '.') ?> đ</td>
            <td>
                <a href="detail.php?id=<?= $row['order_id'] ?>">🔍 Xem chi tiết</a> |
                <a href="update_status.php?id=<?= $row['order_id'] ?>&status=shipped">🚚 Giao hàng</a> |
                <a href="update_status.php?id=<?= $row['order_id'] ?>&status=cancelled">❌ Huỷ</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>