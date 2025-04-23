<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");

$sql = "SELECT p.*, s.shop_name
        FROM products p
        JOIN sellers s ON p.seller_id = s.seller_id
        WHERE p.status = 'pending'";
$result = mysqli_query($conn, $sql);
?>
<?php include '../header.php'; ?>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9;
    }

    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
        font-size: 26px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    }

    th,
    td {
        padding: 16px 18px;
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

    .action-btn {
        padding: 8px 14px;
        border-radius: 6px;
        font-weight: bold;
        text-decoration: none;
        font-size: 14px;
        color: white;
        margin: 0 4px;
        display: inline-block;
        transition: background-color 0.3s;
    }

    .approve {
        background-color: #28a745;
    }

    .approve:hover {
        background-color: #218838;
    }

    .reject {
        background-color: #dc3545;
    }

    .reject:hover {
        background-color: #c82333;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Sản phẩm chờ duyệt</title>
</head>

<body>

    <h2>📝 Danh sách sản phẩm chờ duyệt</h2>

    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Tên Shop</th>
            <th>Giá</th>
            <th>Thao tác</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['shop_name']) ?></td>
                <td><?= number_format($row['price'], 0, ',', '.') ?> đ</td>
                <td>
                    <a href="approve.php?id=<?= $row['product_id'] ?>" class="action-btn approve">✔ Duyệt</a>
                    <a href="reject.php?id=<?= $row['product_id'] ?>" class="action-btn reject">✖ Từ chối</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>
<?php include '../footer.php'; ?>