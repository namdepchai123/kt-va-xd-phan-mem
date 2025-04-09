<?php
$conn = new mysqli("localhost", "root", "", "quanlydangkyhoctructuyen");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
