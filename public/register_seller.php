<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Bạn cần đăng nhập để đăng ký trở thành người bán!'); window.location.href = 'login.php';</script>";
    exit();
}

include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];

    // Cập nhật vai trò của người dùng thành 'seller'
    $conn->begin_transaction(); // Bắt đầu giao dịch
    try {
        // Lấy user_id từ bảng users
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];

            // Cập nhật vai trò thành 'seller'
            $stmt_update = $conn->prepare("UPDATE users SET role = 'seller' WHERE user_id = ?");
            $stmt_update->bind_param("i", $user_id);
            $stmt_update->execute();

            // Thêm bản ghi mới vào bảng sellers
            $stmt_seller = $conn->prepare("INSERT INTO sellers (seller_id) VALUES (?)");
            $stmt_seller->bind_param("i", $user_id);
            $stmt_seller->execute();

            // Hoàn tất giao dịch
            $conn->commit();

            // Cập nhật session và chuyển hướng
            $_SESSION['role'] = 'seller';
            echo "<script>alert('Đăng ký thành công! Bạn đã là người bán.'); window.location.href = 'seller.php';</script>";
        } else {
            throw new Exception("Không tìm thấy thông tin người dùng!");
        }
    } catch (Exception $e) {
        $conn->rollback(); // Hoàn tác giao dịch nếu có lỗi
        echo "<script>alert('Có lỗi xảy ra: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký làm người bán</title>
</head>
<body>
    <h2>Đăng ký trở thành người bán</h2>
    <form method="POST" action="">
        <p>Bạn có muốn trở thành người bán?</p>
        <button type="submit">Đồng ý</button>
    </form>
</body>
</html>