<?php
session_start();
if (!isset($_SESSION['masv'])) header("Location: login.php");

include 'connect.php';
$masv = $_SESSION['masv'];
$dongia_tinchi = 350000;

// Xử lý nếu có yêu cầu hủy môn
if (isset($_GET['delete_mamh'])) {
    $mamh = $_GET['delete_mamh'];

    $delete = $conn->prepare("DELETE FROM dangky WHERE masv = ? AND mamh = ?");
    $delete->bind_param("ss", $masv, $mamh);
    if ($delete->execute()) {
        $message = "Hủy đăng ký môn học thành công.";
    } else {
        $message = "Hủy thất bại.";
    }
    header("Location: mon_da_dangky.php?message=" . urlencode($message));
    exit();
}

// Lấy danh sách môn đã đăng ký
$sql = $conn->prepare("SELECT mh.mamh, mh.tenmh, mh.sotinchi FROM monhoc mh
                      JOIN dangky dk ON mh.mamh = dk.mamh
                      WHERE dk.masv = ?");
$sql->bind_param("s", $masv);
$sql->execute();
$result = $sql->get_result();

// Tính tổng tín chỉ
$tong_tinchi = 0;
$ds_mon = [];
while ($row = $result->fetch_assoc()) {
    $ds_mon[] = $row;
    $tong_tinchi += $row['sotinchi'];
}
$tong_tien = $tong_tinchi * $dongia_tinchi;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Môn học đã đăng ký</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        table { width: 80%; margin: auto; border-collapse: collapse; background: #fff; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background: #4CAF50; color: white; }
        a { color: red; text-decoration: none; }
        .message { text-align: center; margin: 15px; color: green; font-weight: bold; }
        .summary { width: 80%; margin: 20px auto; font-weight: bold; font-size: 16px; }
    </style>
    <script>
        function confirmDelete(mamh) {
            if (confirm("Bạn có chắc chắn muốn hủy đăng ký môn học này không?")) {
                window.location.href = "mon_da_dangky.php?delete_mamh=" + mamh;
            }
        }
    </script>
</head>
<body>

<h2 style="text-align:center;">Danh sách môn học đã đăng ký</h2>

<?php if (isset($_GET['message'])): ?>
    <div class="message"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>

<?php if (count($ds_mon) > 0): ?>
<table>
    <tr>
        <th>Mã môn</th>
        <th>Tên môn</th>
        <th>Số tín chỉ</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($ds_mon as $row): ?>
    <tr>
        <td><?php echo $row['mamh']; ?></td>
        <td><?php echo $row['tenmh']; ?></td>
        <td><?php echo $row['sotinchi']; ?></td>
        <td>
            <a href="#" onclick="confirmDelete('<?php echo $row['mamh']; ?>')">Hủy</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="summary">
    <p>Tổng số tín chỉ: <?php echo $tong_tinchi; ?></p>
    <p>Học phí tạm tính (<?php echo number_format($dongia_tinchi); ?> VNĐ/tín chỉ): 
       <?php echo number_format($tong_tien); ?> VNĐ</p>
</div>

<div style="text-align:center; margin-top: 20px;">
    <a href="index.php" style="padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px;">← Quay lại đăng ký</a>
</div>

<?php else: ?>
    <div class="message">Bạn chưa đăng ký môn học nào.</div>
<?php endif; ?>

</body>
</html>
