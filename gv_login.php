<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM giaovien WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($gv = $result->fetch_assoc()) {
        $_SESSION['magv'] = $gv['magv'];
        $_SESSION['tengv'] = $gv['tengv'];
        header("Location: gv_dashboard.php");
        exit();
    } else {
        $error = "Sai tên đăng nhập hoặc mật khẩu";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Giáo viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ecf0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #34495e;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background: #3498db;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #2980b9;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Đăng nhập Giáo viên</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" required>

            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
