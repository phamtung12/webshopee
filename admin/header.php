<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
        }

        .sidebar {
            width: 220px;
            background: #222;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #444;
        }

        .main {
            margin-left: 230px;
            padding: 20px;
        }

        h2 {
            color: #222;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3 style="text-align:center;">Admin Panel</h3>
        <a href="index.php">🏠 Dashboard</a>
        <a href="../users/list.php">👥 Quản lý người dùng</a>
        <a href="../products/pending.php">📦 Kiểm duyệt sản phẩm</a>
        <a href="../orders/list.php">🧾 Quản lý đơn hàng</a>
        <a href="../reports/list.php">🚩 Xử lý báo cáo</a>
        <a href="../categories/list.php">📂 Danh mục sản phẩm</a>
        <a href="../brands/list.php">🏷️ Thương hiệu</a>
        <a href="../dashboard/stats.php">📊 Thống kê</a>
    </div>

    <div class="main">