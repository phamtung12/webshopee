<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = $id");
$row = mysqli_fetch_assoc($result);
?>
<style>
    form {
        max-width: 500px;
        margin: 40px auto;
        padding: 30px;
        background-color: #f0f8ff;
        border: 1px solid #cce0f5;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
        font-family: 'Segoe UI', sans-serif;
    }

    form h2 {
        text-align: center;
        color: #0056b3;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #003366;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #99c2ff;
        background-color: #ffffff;
        font-size: 16px;
        color: #003366;
        margin-bottom: 20px;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
<h2>Chỉnh sửa Danh mục</h2>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?= $row['category_id'] ?>">
    <label>Tên danh mục:</label><br>
    <input type="text" name="name" value="<?= $row['name'] ?>" required><br><br>
    <button type="submit">💾 Cập nhật</button>
</form>

<?php include '../footer.php'; ?>