<?php
// Kết nối tới cơ sở dữ liệu
include '../db.php';

$username = $_SESSION['username'];

// Lấy thông tin seller_id từ bảng users
$sql = "SELECT user_id FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seller_id = $row['user_id'];
    }
} else {
    echo "Không tìm thấy người bán.";
    exit;
}

// Lấy danh sách sản phẩm theo seller_id, bao gồm hình ảnh
$sql = "
    SELECT p.product_id, p.name, p.price, p.stock_quantity, p.status, 
           c.name AS category_name, b.name AS brand_name, 
           pi.image_url 
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    LEFT JOIN brands b ON p.brand_id = b.brand_id
    LEFT JOIN product_images pi ON p.product_id = pi.product_id
    WHERE p.seller_id = '$seller_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm của tôi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        .product-container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            text-align: center  ;
            padding: 10px;
        }
        th {
            background-color: #ee4d2d;
            color: white;
        }
        td {
            color: #555;
        }
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        .actions a {
            text-decoration: none;
            color: white;
            background-color: #ee4d2d;
            padding: 8px 12px;
            border-radius: 4px;
            margin-right: 5px;
        }
        .actions a:hover {
            background-color: #d8431f;
        }
    </style>
</head>
<body>
    <div class="product-container">
        <h2>Danh sách sản phẩm của bạn</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Giá</th>
                        <th>Số lượng tồn kho</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <img src="../assets/images/<?php echo $row['image_url']; ?>" alt="Hình ảnh sản phẩm" class="product-image">
                            </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['brand_name']; ?></td>
                            <td><?php echo $row['price']; ?> VNĐ</td>
                            <td><?php echo $row['stock_quantity']; ?></td>
                            <td>
                                <?php
                                 if ($row['status'] === 'pending') {
                                     echo 'Đang duyệt';
                                  } elseif ($row['status'] === 'approved') {
                                    echo 'Đã duyệt';
                                  } else {
                                    echo 'Bị từ chối';
                                 }
                        ?>
                              </td>
                            <td class="actions">
                                <a href="?page=edit&id=<?php echo $row['product_id']; ?>">Sửa</a>
                                <a href="?page=delete&id=<?php echo $row['product_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có sản phẩm nào được thêm vào.</p>
        <?php endif; ?>
    </div>
</body>
</html>