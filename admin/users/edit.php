<?php
$conn = mysqli_connect("localhost", "root", "phamtung", "qlbh");
include '../header.php';

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM users WHERE user_id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<style>
    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        font-family: 'Arial', sans-serif;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    label {
        font-size: 16px;
        color: #444;
        margin-bottom: 8px;
        display: block;
        font-family: 'Arial', sans-serif;
    }

    input[type="text"],
    input[type="email"],
    select {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 2px solid #007BFF;
        border-radius: 6px;
        margin-bottom: 15px;
        outline: none;
        background-color: #fff;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    select:focus {
        border-color: #0056b3;
        box-shadow: 0 0 8px rgba(0, 91, 181, 0.3);
    }

    button {
        padding: 12px 20px;
        background-color: #007BFF;
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .form-group {
        margin-bottom: 20px;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        form {
            padding: 20px;
        }

        input[type="text"],
        input[type="email"],
        select,
        button {
            font-size: 14px;
            padding: 10px;
        }
    }
</style>
<h2>Chỉnh sửa người dùng</h2>

<form method="post" action="update.php">
    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

    <label>Tên đăng nhập:</label><br>
    <input type="text" name="username" value="<?= $user['username'] ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>

    <label>Điện thoại:</label><br>
    <input type="text" name="phone" value="<?= $user['phone'] ?>"><br><br>

    <label>Vai trò:</label><br>
    <select name="role">
        <option value="customer" <?= $user['role'] === 'customer' ? 'selected' : '' ?>>Customer</option>
        <option value="seller" <?= $user['role'] === 'seller' ? 'selected' : '' ?>>Seller</option>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br><br>

    <button type="submit">💾 Cập nhật</button>
</form>

<?php include '../footer.php'; ?>