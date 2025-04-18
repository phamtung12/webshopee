<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$order_id = $_GET['id'];

$sql = "SELECT oi.*, p.name
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        WHERE oi.order_id = $order_id";

$result = mysqli_query($conn, $sql);
?>

<h2>🧾 Chi tiết đơn hàng #<?= $order_id ?></h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= number_format($row['price'], 0, ',', '.') ?> đ</td>
        </tr>
    <?php endwhile; ?>
</table>

<p><a href="list.php">⬅ Quay lại</a></p>

<?php include '../footer.php'; ?>