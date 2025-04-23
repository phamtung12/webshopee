<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

// Thống kê người dùng theo vai trò
$userStats = mysqli_query($conn, "SELECT role, COUNT(*) as total FROM users GROUP BY role");

// Tổng sản phẩm
$productTotal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products"))['total'] ?? 0;

// Tổng đơn hàng
$orderTotal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'] ?? 0;

// Doanh thu
$revenue = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT SUM(total_price) as total FROM orders WHERE status IN ('paid', 'delivered')
"))['total'] ?? 0;

// Đơn hàng theo tháng
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

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
        color: #333;
    }

    ul {
        list-style: none;
        padding: 0;
        margin-left: 30px;
        font-size: 17px;
    }

    li {
        margin: 8px 0;
    }

    canvas {
        display: block;
        margin: 30px auto;
        max-width: 90%;
    }
</style>

<h2>📊 Bảng điều khiển thống kê</h2>

<h3>👥 Người dùng theo vai trò</h3>
<ul>
    <?php while ($row = mysqli_fetch_assoc($userStats)) : ?>
        <li>🔹 <strong><?= ucfirst($row['role']) ?>:</strong> <?= $row['total'] ?></li>
    <?php endwhile; ?>
</ul>

<h3>📌 Tổng số</h3>
<ul>
    <li>🛍️ <strong>Sản phẩm:</strong> <?= $productTotal ?></li>
    <li>📦 <strong>Đơn hàng:</strong> <?= $orderTotal ?></li>
    <li>💰 <strong>Doanh thu:</strong> <?= number_format($revenue, 0, ',', '.') ?> VND</li>
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
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

<?php include '../footer.php'; ?>