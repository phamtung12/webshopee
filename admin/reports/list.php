<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$sql = "SELECT r.*, p.name AS product_name
        FROM reports r
        JOIN products p ON r.product_id = p.product_id
        ORDER BY r.created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<h2>📋 Danh sách báo cáo vi phạm</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Sản phẩm</th>
        <th>Lý do</th>
        <th>Ngày tạo</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['report_id'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?= $row['reason'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
            <td>
                <?php if ($row['status'] != 'resolved'): ?>
                    <a href="update.php?id=<?= $row['report_id'] ?>&status=reviewed">👁️ Đánh dấu đã xem</a> |
                    <a href="update.php?id=<?= $row['report_id'] ?>&status=resolved">✅ Đã xử lý</a> |
                <?php endif; ?>
                <a href="delete.php?id=<?= $row['report_id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../footer.php'; ?>