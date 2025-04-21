<?php

include '../db.php';

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Bạn cần đăng nhập để thực hiện thao tác này.'); window.location.href = 'login.php';</script>";
    exit();
}

$username = $_SESSION['username'];

// Lấy thông tin hiện tại của người bán từ bảng sellers
$sql_select = "SELECT * FROM sellers WHERE seller_id = (SELECT user_id FROM users WHERE username = ?)";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("s", $username);
$stmt_select->execute();
$result = $stmt_select->get_result();
$sellerInfo = $result->fetch_assoc();
$stmt_select->close();

// Kiểm tra nếu thông tin tài khoản chưa đầy đủ
$needs_update = !$sellerInfo || empty($sellerInfo['shop_name']) || empty($sellerInfo['description']) || empty($sellerInfo['shop_avatar']);

// Xử lý logic cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_account'])) {
    $shop_name = $_POST['shop_name'];
    $description = $_POST['description'];

    // Xử lý hình ảnh avatar (nếu có)
    if (isset($_FILES['shop_avatar']) && $_FILES['shop_avatar']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "./uploads/";
        $unique_name = uniqid() . "_" . basename($_FILES['shop_avatar']['name']);
        $target_file = $target_dir . $unique_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng hình ảnh
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Chỉ chấp nhận các định dạng JPG, JPEG, PNG hoặc GIF.');</script>";
            exit();
        }

        // Di chuyển hình ảnh đến thư mục đích
        if (move_uploaded_file($_FILES['shop_avatar']['tmp_name'], $target_file)) {
            $shop_avatar = $target_file;
        } else {
            echo "<script>alert('Lỗi khi tải lên hình ảnh.');</script>";
            exit();
        }
    } else {
        // Nếu không tải lên hình ảnh mới, giữ nguyên hình ảnh cũ
        $shop_avatar = $sellerInfo['shop_avatar'] ?? null;
    }

    // Cập nhật thông tin vào cơ sở dữ liệu
    $sql_update = "UPDATE sellers SET shop_name = ?, description = ?, shop_avatar = ? WHERE seller_id = (SELECT user_id FROM users WHERE username = ?)";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssss", $shop_name, $description, $shop_avatar, $username);

    if ($stmt_update->execute()) {
        echo "<script>alert('Thông tin tài khoản đã được cập nhật.'); window.location.href = 'update_seller.php';</script>";
    } else {
        echo "<script>alert('Đã xảy ra lỗi khi cập nhật thông tin tài khoản.');</script>";
    }
    $stmt_update->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
          
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input, textarea, button {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        img {
            max-width: 200px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if ($needs_update): ?>
        <!-- Hiển thị form cập nhật -->
        <h2>Cập nhật thông tin tài khoản</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="shop_name">Tên cửa hàng:</label>
            <input type="text" id="shop_name" name="shop_name" value="<?php echo htmlspecialchars($sellerInfo['shop_name'] ?? '', ENT_QUOTES); ?>" required>

            <label for="description">Mô tả cửa hàng:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($sellerInfo['description'] ?? '', ENT_QUOTES); ?></textarea>

            <label for="shop_avatar">Avatar cửa hàng:</label>
            <input type="file" id="shop_avatar" name="shop_avatar" required>

            <button type="submit" name="update_account">Cập nhật</button>
        </form>
    <?php else: ?>
        <!-- Hiển thị thông tin tài khoản -->
        <h2>Thông tin tài khoản của bạn</h2>
        <p><strong>Tên cửa hàng:</strong> <?php echo htmlspecialchars($sellerInfo['shop_name'], ENT_QUOTES); ?></p>
        <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($sellerInfo['description'], ENT_QUOTES); ?></p>
        <p><strong>Avatar:</strong></p>
        <img src="<?php echo htmlspecialchars($sellerInfo['shop_avatar'], ENT_QUOTES); ?>" alt="Avatar cửa hàng">
        <form method="POST" action="">
            <button type="submit" name="edit_mode">Sửa thông tin</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>