<?php include '../header.php'; ?>

<h2>➕ Thêm thương hiệu</h2>

<form action="insert.php" method="post">
    <label>Tên thương hiệu:</label><br>
    <input type="text" name="name" required><br><br>
    <button type="submit">💾 Lưu</button>
</form>

<?php include '../footer.php'; ?>