<?php include '../header.php'; ?>

<h2>Thêm Danh mục mới</h2>

<form method="post" action="insert.php">
    <label>Tên danh mục:</label><br>
    <input type="text" name="name" required><br><br>
    <button type="submit">💾 Lưu</button>
</form>

<?php include '../footer.php'; ?>