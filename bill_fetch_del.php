<?php
include('conf.php');
session_start();

$borrow_bill = $_POST['borrow_bill'];

$sql = "DELETE FROM borrow_bill WHERE borrow_bill = '$borrow_bill'";
$query = $conn->query($sql);


$sql = "DELETE FROM borrow WHERE borrow_id = '$borrow_bill'";
$query = $conn->query($sql);


echo 'ลบรายการ'.' '.'หมายเลขใบยืม :'.$borrow_bill. ' '.' เรียนร้อย';





?>
