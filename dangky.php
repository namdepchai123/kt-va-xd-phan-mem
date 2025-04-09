<?php
session_start();
if (!isset($_SESSION['masv'])) header("Location: login.php");

include 'connect.php';
$masv = $_SESSION['masv'];
$mamh = $_GET['mamh'];

// Kiểm tra đã đăng ký chưa
$check = $conn->prepare("SELECT * FROM dangky WHERE masv = ? AND mamh = ?");
$check->bind_param("ss", $masv, $mamh);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    header("Location: index.php?message=" . urlencode("Bạn đã đăng ký môn này rồi."));
    exit();
}

// Thêm vào bảng đăng ký
$sql = $conn->prepare("INSERT INTO dangky (masv, mamh) VALUES (?, ?)");
$sql->bind_param("ss", $masv, $mamh);
if ($sql->execute()) {
    // Lấy tên môn
    $tenmh = '';
    $mh = $conn->prepare("SELECT tenmh FROM monhoc WHERE mamh = ?");
    $mh->bind_param("s", $mamh);
    $mh->execute();
    $res = $mh->get_result();
    if ($row = $res->fetch_assoc()) {
        $tenmh = $row['tenmh'];
    }

    header("Location: index.php?message=" . urlencode("Đăng ký thành công môn: $tenmh"));
} else {
    header("Location: index.php?message=" . urlencode("Đăng ký thất bại."));
}
exit();
