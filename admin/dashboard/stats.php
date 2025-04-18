<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include 'header.php';

// Thống kê người dùng theo vai trò
$userStats = mysqli_query($conn, "
    SELECT role, COUNT(*) as total FROM users GROUP BY role
");

// Tổng sản phẩm
$productResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
$productTotal = mysqli_fetch_assoc($productResult)['total'];

// Tổng đơn hàng
$orderResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM orders");
$orderTotal = mysqli_fetch_assoc($orderResult)['total'];

// Doanh thu (paid hoặc delivered)
$revenueResult = mysqli_query($conn, "
    SELECT SUM(total_price) as total FROM orders WHERE status IN ('paid', 'delivered')
");
$revenue = mysqli_fetch_assoc($revenueResult)['total'];

// Dữ liệu đơn hàng theo tháng
$orderChart = mysqli_query($conn, "
    SELECT MONTH(order_date) as month, COUNT(*) as total
    FROM orders
    GROUP BY MONTH(order_date)
    ORDER BY month
");

$months = [];
$orderCounts = [];

while ($row = mysqli_fetch_assoc($orderChart)) {
    $months[] = 'Tháng ' . $row['month'];
    $orderCounts[] = $row['total'];
}
?>

<h2>📊 Bảng điều khiển thống kê</h2>

<h3>Người dùng theo vai trò</h3>
<ul>
    <?php while ($row = mysqli_fetch_assoc($userStats)) : ?>
        <li><?= ucfirst($row['role']) ?>: <?= $row['total'] ?></li>
    <?php endwhile; ?>
</ul>

<h3>Tổng số</h3>
<ul>
    <li>🛍️ Sản phẩm: <?= $productTotal ?></li>
    <li>📦 Đơn hàng: <?= $orderTotal ?></li>
    <li>💰 Doanh thu: <?= number_format($revenue, 0, ',', '.') ?> VND</li>
</ul>

<h3>📈 Biểu đồ đơn hàng theo tháng</h3>
<canvas id="orderChart" width="600" height="300"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('orderChart').getContext('2d');
    const orderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($months) ?>,
            datasets: [{
                label: 'Số lượng đơn hàng',
                data: <?= json_encode($orderCounts) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>

<?php include 'footer.php'; ?>