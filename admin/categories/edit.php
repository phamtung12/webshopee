<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = $id");
$row = mysqli_fetch_assoc($result);
?>

<h2>Chỉnh sửa Danh mục</h2>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?= $row['category_id'] ?>">
    <label>Tên danh mục:</label><br>
    <input type="text" name="name" value="<?= $row['name'] ?>" required><br><br>
    <button type="submit">💾 Cập nhật</button>
</form>

<?php include '../footer.php'; ?>