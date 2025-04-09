<?php
session_start();
if (!isset($_SESSION['masv'])) header("Location: login.php");

include 'connect.php';
$masv = $_SESSION['masv'];

$sql = "SELECT * FROM monhoc WHERE mamh NOT IN (
    SELECT mamh FROM dangky WHERE masv = '$masv'
)";
$result = $conn->query($sql);?>
<?php if (isset($_GET['message'])): ?>
    <div style="color: green; font-weight: bold; margin: 10px 0;">
        <?php echo htmlspecialchars($_GET['message']); ?>
    </div>
<?php endif; ?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Môn Học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white">
<div class="container mt-4">
    <h4>Xin chào, <?= $_SESSION['tensv'] ?> (<?= $masv ?>)
        <a href="logout.php" class="btn btn-sm btn-danger float-end">Đăng xuất</a>
    </h4>
    <h5 class="mt-4">Danh sách môn học:</h5>
    <a href="mon_da_dangky.php" class="btn btn-outline-primary btn-sm mb-3">Xem môn đã đăng ký</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã MH</th>
                <th>Tên MH</th>
                <th>Số tín chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['mamh'] ?></td>
                <td><?= $row['tenmh'] ?></td>
                <td><?= $row['sotinchi'] ?></td>
                <td>
                    <a href="dangky.php?mamh=<?= $row['mamh'] ?>" class="btn btn-success btn-sm">Đăng ký</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
