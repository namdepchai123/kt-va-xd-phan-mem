<?php
session_start();
if (!isset($_SESSION['masv'])) header("Location: login.php");

include 'connect.php';
$masv = $_SESSION['masv'];
$mamh = $_GET['mamh'];

$sql = "DELETE FROM dangky WHERE masv = '$masv' AND mamh = '$mamh'";
$conn->query($sql);

header("Location: mon_da_dangky.php");
