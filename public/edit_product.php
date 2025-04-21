<?php
include '../db.php';
// Kiểm tra nếu có ID sản phẩm được truyền qua URL
if (!isset($_GET['id'])) {
    echo "<script>alert('Không tìm thấy sản phẩm để sửa!'); window.location.href = 'seller.php';</script>";
    exit;
}

$product_id = intval($_GET['id']);

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE product_id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy sản phẩm này!'); window.location.href = 'seller.php';</script>";
    exit;
}

// Cập nhật sản phẩm khi biểu mẫu được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $category_id = intval($_POST["category_id"]);
    $brand_id = intval($_POST["brand_id"]);
    $price = floatval($_POST["price"]);
    $stock_quantity = intval($_POST["stock_quantity"]);
    $description = $_POST["description"];

    $sql = "UPDATE products SET 
                name = '$name', 
                category_id = '$category_id', 
                brand_id = '$brand_id', 
                price = '$price', 
                stock_quantity = '$stock_quantity', 
                description = '$description' 
            WHERE product_id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Sửa sản phẩm thành công!'); window.location.href = 'seller.php';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        .edit-container {
            max-width: 600px;
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
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #ee4d2d;
            outline: none;
        }
        .submit-btn {
            background-color: #ee4d2d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: auto;
        }
        .submit-btn:hover {
            background-color: #d8431f;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h2>Sửa sản phẩm</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select name="category_id" id="category_id" required>
                    <?php
                    // Lấy danh sách danh mục từ cơ sở dữ liệu
                    $sql = "SELECT * FROM categories";
                    $categories = $conn->query($sql);
                    while ($row = $categories->fetch_assoc()) {
                        $selected = ($row['category_id'] == $product['category_id']) ? 'selected' : '';
                        echo "<option value='{$row['category_id']}' $selected>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="brand_id">Thương hiệu</label>
                <select name="brand_id" id="brand_id" required>
                    <?php
                    // Lấy danh sách thương hiệu từ cơ sở dữ liệu
                    $sql = "SELECT * FROM brands";
                    $brands = $conn->query($sql);
                    while ($row = $brands->fetch_assoc()) {
                        $selected = ($row['brand_id'] == $product['brand_id']) ? 'selected' : '';
                        echo "<option value='{$row['brand_id']}' $selected>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Giá (VNĐ)</label>
                <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="stock_quantity">Số lượng trong kho</label>
                <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" rows="4"><?php echo $product['description']; ?></textarea>
            </div>

            <button type="submit" class="submit-btn">Cập nhật</button>
        </form>
    </div>
</body>
</html>