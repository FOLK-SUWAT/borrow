<?php
@include('conf.php');
session_start();
$output = array();
$Today;
date_default_timezone_set('Asia/Bangkok');
$date = new DateTime();
$resultdate = $date->format('d-m-Y');

$sql = "SELECT * FROM borrow_bill 
WHERE borrow_bill.member_id= '$_SESSION[member_id]'  
ORDER BY `borrow_bill`.`borrow_id`  DESC
";
$query = $conn->query($sql);
while ($row = $query->fetch_array()) {
	$output[] = $row;
}

echo json_encode($output);
