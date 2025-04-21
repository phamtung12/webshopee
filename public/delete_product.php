<?php
// Kết nối tới cơ sở dữ liệu
include '../db.php';

// Lấy `product_id` từ URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Không tìm thấy sản phẩm để xóa!'); window.location.href = 'seller.php';</script>";
    exit;
}

$product_id = intval($_GET['id']);

try {
    // Bắt đầu thực hiện xóa
    // Xóa các hình ảnh liên quan đến sản phẩm
    $sql1 = "DELETE FROM product_images WHERE product_id = '$product_id'";
    if ($conn->query($sql1) === TRUE) {
        // Tiếp tục xóa sản phẩm
        $sql2 = "DELETE FROM products WHERE product_id = '$product_id'";
        if ($conn->query($sql2) === TRUE) {
            echo "<script>alert('Xóa sản phẩm thành công!'); window.location.href = 'seller.php';</script>";
        } else {
            throw new Exception("Lỗi khi xóa sản phẩm: " . $conn->error);
        }
    } else {
        throw new Exception("Lỗi khi xóa hình ảnh liên quan: " . $conn->error);
    }
} catch (Exception $e) {
    echo "<script>alert('" . $e->getMessage() . "'); window.location.href = 'seller.php';</script>";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>