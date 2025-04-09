<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['masv'] = $_POST['masv'];
    $_SESSION['tensv'] = $_POST['tensv'];
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chọn Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Chọn Sinh Viên</h4>
        <form method="post">
            <div class="mb-3">
                <label for="masv" class="form-label">Mã Sinh Viên</label>
                <input type="text" class="form-control" name="masv" required>
            </div>
            <div class="mb-3">
                <label for="tensv" class="form-label">Tên Sinh Viên</label>
                <input type="text" class="form-control" name="tensv" required>
            </div>
            <button type="submit" class="btn btn-primary">Vào Hệ Thống</button>
        </form>
    </div>
</div>
</body>
</html>
