<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");

$sql = "SELECT p.*, s.shop_name
        FROM products p
        JOIN sellers s ON p.seller_id = s.seller_id
        WHERE p.status = 'pending'";
$result = mysqli_query($conn, $sql);
?>

<h2>Sản phẩm chờ duyệt</h2>
<table border="1">
    <tr>
        <th>Tên sản phẩm</th>
        <th>Shop</th>
        <th>Giá</th>
        <th>Thao tác</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['shop_name'] ?></td>
            <td><?= $row['price'] ?></td>
            <td>
                <a href="approve.php?id=<?= $row['product_id'] ?>">Duyệt</a> |
                <a href="reject.php?id=<?= $row['product_id'] ?>">Từ chối</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>