<?php
session_start();
if (!isset($_SESSION['magv'])) header("Location: gv_login.php");
include 'connect.php';

// Lấy danh sách môn học
$monhoc = $conn->query("SELECT * FROM monhoc");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Giáo viên - Xem sinh viên đăng ký</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 80px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
        }
        h3 {
            text-align: center;
            color: #34495e;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        select {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px 25px;
            font-size: 16px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
        .logout {
            display: block;
            text-align: center;
            margin-top: 25px;
        }
        .logout a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }
        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Xin chào, <?php echo $_SESSION['tengv']; ?>!</h2>
        <h3>Chọn môn học để xem sinh viên đã đăng ký</h3>
        <form method="get" action="gv_xem_sinhvien.php">
            <select name="mamh" required>
                <option value="">-- Chọn môn học --</option>
                <?php while ($mh = $monhoc->fetch_assoc()): ?>
                    <option value="<?= $mh['mamh'] ?>"><?= $mh['tenmh'] ?> (<?= $mh['mamh'] ?>)</option>
                <?php endwhile; ?>
            </select><br>
            <button type="submit">Xem danh sách</button>
        </form>
        <div class="logout">
            <a href="logout.php">Đăng xuất</a>
        </div>
    </div>
</body>
</html>
