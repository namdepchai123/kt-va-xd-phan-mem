<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['magv'])) {
    header("Location: gv_login.php");
    exit();
}

$sinhviens = [
    [
        'masv' => '227480201103',
        'tensv' => 'Trang Phước Nam'
    ],
    [
        'masv' => '227480201094',
        'tensv' => 'Huỳnh Phúc Hậu'
    ]
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đăng ký của sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { color: #2c3e50; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f9f9f9; }
        h3 { margin-top: 40px; color: #2980b9; }
    </style>
</head>
<body>
    <?php foreach ($sinhviens as $sv): ?>
        <h3>Danh sách môn học sinh viên: <?= $sv['tensv'] ?> (<?= $sv['masv'] ?>) đã đăng ký</h3>
        <table>
            <tr>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Kỳ học</th>
                <th>Số tín chỉ</th>
            </tr>
            <?php
            $stmt = $conn->prepare("
                SELECT dk.mamh, mh.tenmh, dk.kyhoc, mh.sotinchi
                FROM dangky dk
                JOIN monhoc mh ON dk.mamh = mh.mamh
                WHERE dk.masv = ?
            ");
            $stmt->bind_param("s", $sv['masv']);
            $stmt->execute();
            $result = $stmt->get_result();

            $tongTC = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tongTC += $row['sotinchi'];
                    echo "<tr>
                            <td>{$row['mamh']}</td>
                            <td>{$row['tenmh']}</td>
                            <td>{$row['kyhoc']}</td>
                            <td>{$row['sotinchi']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Sinh viên chưa đăng ký môn học nào.</td></tr>";
            }
            ?>
        </table>
        <p><strong>Tổng số tín chỉ:</strong> <?= $tongTC ?> | <strong>Tổng tiền:</strong> <?= number_format($tongTC * 350000) ?> VNĐ</p>
    <?php endforeach; ?>
</body>
</html>
