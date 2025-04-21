<?php include '../db.php';

$username = $_SESSION['username'];
$sql = "SELECT user_id FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];
    }
} else {
    echo "Không tìm thấy người dùng";
}
if (!isset($_POST['category_id']) || !isset($_POST['brand_id'])) {
    $category_id = null;
    $brand_id = null;
} else {
    $category = $_POST['category_id'];
    $sql = "SELECT category_id FROM categories WHERE name = '$category'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $category_id = $row['category_id'];
        }
    } else {
        echo "Không tìm thấy danh mục";
    }
    $brand = $_POST['brand_id'];
    $sql = "SELECT brand_id FROM brands WHERE name = '$brand'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brand_id = $row['brand_id'];
        }
    } else {
        echo "Không tìm thấy thương hiệu";
    }
}
$username = $_SESSION['username'];
$sql = "SELECT * FROM sellers WHERE seller_id = (SELECT user_id FROM users WHERE username = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$sellerInfo = $result->fetch_assoc();
if (!$sellerInfo || empty($sellerInfo['shop_name']) || empty($sellerInfo['description']) || empty($sellerInfo['shop_avatar'])) {
    echo "<script>alert('Bạn cần cập nhật đầy đủ thông tin tài khoản trước khi thêm sản phẩm.'); window.location.href = 'update_seller.php';</script>";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
        $category_id = intval($_POST['category_id']);
    } else {
        echo "<script>alert('Vui lòng chọn danh mục hợp lệ!');</script>";
        exit;
    }
    if (isset($_POST['brand_id']) && !empty($_POST['brand_id'])) {
        $brand_id = intval($_POST['brand_id']);
    } else {
        echo "<script>alert('Vui lòng chọn thương hiệu hợp lệ!');</script>";
        exit;
    }
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];
    $description = $_POST["description"];
    $discount = $_POST["discount"];
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        $img = time() . '_' . uniqid() . '_' . basename($_FILES['images']['name']);
        $target = __DIR__ . "/../assets/images/" . $img;
        // Di chuyển tệp tin vào thư mục đích
        if (move_uploaded_file($_FILES['images']['tmp_name'], $target)) {
            // Tệp tin đã được di chuyển thành công
        } else {
            echo "<script>alert('Lỗi: Không thể di chuyển tệp vào thư mục đích.');</script>";
            exit;
        }
    } elseif (isset($_FILES['images']) && $_FILES['images']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Lỗi tải file. Mã lỗi: " . $_FILES['images']['error'] . "');</script>";
        exit;
    } else {
        echo "<script>alert('Vui lòng chọn hình ảnh!');</script>";
        exit;
    }
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $file_extension = pathinfo($img, PATHINFO_EXTENSION);
    $sql = "INSERT INTO products (seller_id, name, category_id, brand_id, price, discount, stock_quantity, description, status)
        VALUES ('$user_id', '$name', '$category_id', '$brand_id', '$price', '$discount', '$stock_quantity', '$description', 'pending')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id; // Get the last inserted ID
        $sql2 = "INSERT INTO product_images (product_id, image_url) VALUES ('$last_id', '$img')";
        if ($conn->query($sql2) === TRUE) {
            echo "<script>alert('Thêm sản phẩm thành công.');
            window.location.href = 'seller.php';
            </script>";
            exit;
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        echo "<script>alert('Định dạng tệp tin không hợp lệ! Chỉ chấp nhận JPG, JPEG, PNG, hoặc GIF.');</script>";
        exit;
    }
}
$conn->close();
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .main {
        display: flex;
        text-align: center;
        justify-content: center;
        align-items: center;
    }

    .product-form-container {
        background: #fff;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 600px;
        font-family: 'Segoe UI', sans-serif;
        margin: auto;
    }

    .form-title {
        font-size: 24px;
        margin-bottom: 25px;
        color: #222;
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
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input[type="file"] {
        border: none;
        font-size: 14px;
        margin-top: 6px;
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
    }

    .submit-btn:hover {
        background-color: #d8431f;
    }
</style>

<body>
    <div class="product-form-container" id="addProductForm">
        <h2 class="form-title">Thêm Sản Phẩm Mới</h2>
        <form id="productForm" enctype="multipart/form-data" method="POST" action="">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <?php
                // Kết nối tới cơ sở dữ liệu
                include('../db.php');
                // Kiểm tra kết nối
                // Truy vấn dữ liệu
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);
                // Tạo select option
                echo '<select name="category_id" id="category_id" required>';
                echo '<option value="">Vui lòng chọn</option>';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['category_id'] . '">' . $row['name'] . '</option>';
                    }
                } else {
                    echo '<option>Không có dữ liệu</option>';
                }
                echo '</select>';

                $conn->close();
                ?>

            </div>

            <div class="form-group">
                <label for="brand_id">Thương hiệu</label>
                <?php
                // Kết nối tới cơ sở dữ liệu
                include('../db.php');
                // Kiểm tra kết nối
                // Truy vấn dữ liệu
                $sql = "SELECT * FROM brands";
                $result = $conn->query($sql);
                // Tạo select option
                echo '<select name="brand_id" id="brand_id" required>';
                echo '<option value="">Vui lòng chọn</option>';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['brand_id'] . '">' . $row['name'] . '</option>';
                    }
                } else {
                    echo '<option>Không có dữ liệu</option>';
                }
                echo '</select>';

                $conn->close();
                ?>
            </div>
            <div class="form-group">
                <label for="discount">Giảm giá (%)</label>
                <input type="number" id="discount" name="discount" step="0.01" min="0" max="100" required>
            </div>

            <div class="form-group">
                <label for="price">Giá (VNĐ)</label>
                <input type="number" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="stock_quantity">Số lượng trong kho</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="images">Ảnh sản phẩm</label>
                <input type="file" id="images" name="images" multiple>
            </div>

            <button type="submit" class="submit-btn">Thêm sản phẩm</button>
        </form>
    </div>
</body>
<script>
    document.getElementById("productForm").onsubmit = function(e) {
        if (document.getElementById("category_id").value === "") {
            alert("Vui lòng chọn danh mục.");
            e.preventDefault();
        }
        if (document.getElementById("brand_id").value === "") {
            alert("Vui lòng chọn thương hiệu.");
            e.preventDefault();
        }
    };
    document.getElementById("productForm").onsubmit = function(e) {
        const price = document.getElementById("price").value;
        if (price > 999999999.999) {
            alert("Giá tiền vượt quá giới hạn cho phép!");
            e.preventDefault();
        }
    };

    const discount = document.getElementById("discount").value;
    if (discount < 0 || discount > 100) {
        alert("Giảm giá phải từ 0 đến 100%");
        e.preventDefault();
    }
</script>

</html>