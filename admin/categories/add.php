<?php include '../header.php'; ?>

<style>
    h2 {
        text-align: center;
        color: #333;
        font-family: 'Segoe UI', sans-serif;
        margin-top: 20px;
        margin-bottom: 30px;
    }

    form {
        max-width: 500px;
        margin: auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        font-weight: bold;
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
        display: block;
    }

    input[type="text"] {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 2px solid #007BFF;
        border-radius: 6px;
        margin-bottom: 20px;
        background-color: #fff;
        outline: none;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus {
        border-color: #0056b3;
        box-shadow: 0 0 6px rgba(0, 91, 181, 0.3);
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #007BFF;
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
<h2>Thêm Danh mục mới</h2>

<form method="post" action="insert.php">
    <label>Tên danh mục:</label><br>
    <input type="text" name="name" required><br><br>
    <button type="submit">💾 Lưu</button>
</form>

<?php include '../footer.php'; ?>