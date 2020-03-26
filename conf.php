<?php
date_default_timezone_set("Asia/Bangkok");

$conn = new mysqli('localhost', 'root', '', 'e-borrow');
mysqli_set_charset($conn, 'utf8');
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>

