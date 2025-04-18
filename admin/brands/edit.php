<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM brands WHERE brand_id = $id");
$row = mysqli_fetch_assoc($result);
?>

<h2>✏️ Chỉnh sửa thương hiệu</h2>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?= $row['brand_id'] ?>">
    <label>Tên thương hiệu:</label><br>
    <input type="text" name="name" value="<?= $row['name'] ?>" required><br><br>
    <button type="submit">💾 Cập nhật</button>
</form>

<?php include '../footer.php'; ?>