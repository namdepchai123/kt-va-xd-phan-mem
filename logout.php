<?php
session_start();
session_destroy();
header("Location: gv_login.php"); // hoặc login.php tùy theo loại người dùng
exit();
