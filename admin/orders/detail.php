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
<style>
    h2 {
        text-align: center;
        margin-top: 20px;
        color: #333;
        font-family: 'Segoe UI', sans-serif;
    }

    table {
        width: 80%;
        margin: 30px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th,
    td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:hover {
        background-color: #f2f2f2;
    }

    a {
        display: block;
        width: 150px;
        margin: 20px auto;
        text-align: center;
        background-color: #007BFF;
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    a:hover {
        background-color: #0056b3;
    }
</style>
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