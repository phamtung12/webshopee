<!-- Kết quả Tìm kiếm -->
<div class="search-results">
    <?php
    include('../db.php'); // Đảm bảo đường dẫn đúng

    // Lấy từ khóa tìm kiếm từ form
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

    // Truy vấn tìm kiếm sản phẩm theo tên hoặc mô tả
    $sql = "SELECT p.product_id, p.name, p.price, p.description, c.name AS category_name, b.name AS brand_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id
                LEFT JOIN brands b ON p.brand_id = b.brand_id
                WHERE (p.name LIKE '%$search_query%' OR p.description LIKE '%$search_query%') AND p.status = 'approved'";

    $result = mysqli_query($conn, $sql);

    // Hiển thị kết quả tìm kiếm
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Kết quả tìm kiếm cho: '" . htmlspecialchars($search_query) . "'</h2>";
        echo "<div class='product-list'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='product'>
                        <h3>" . $row['name'] . "</h3>
                        <p><strong>Thương hiệu:</strong> " . $row['brand_name'] . "</p>
                        <p><strong>Danh mục:</strong> " . $row['category_name'] . "</p>
                        <p><strong>Mô tả:</strong> " . $row['description'] . "</p>
                        <p><strong>Giá:</strong> " . number_format($row['price'], 2) . " VND</p>
                      </div>";
        }
        echo "</div>";
    } else {
        echo "<p>Không tìm thấy sản phẩm nào.</p>";
    }

    // Đóng kết nối
    mysqli_close($conn);
    ?>
</div>