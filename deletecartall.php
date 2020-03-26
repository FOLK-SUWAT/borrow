<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include('conf.php');

$data = json_decode(file_get_contents("php://input"));

$member_id =  $_SESSION['member_id'];

$sql = "DELETE FROM borrowcart WHERE member_id = $member_id";
mysqli_query($conn, $sql);

$query = $conn->query($sql);