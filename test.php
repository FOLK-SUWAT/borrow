<?php 

$borrow_date =  '2019-12-01 12:00';
$borrow_date = str_replace('-', '/', $borrow_date);
$borrow_date = date('Y-m-d h:i', strtotime($borrow_date));

$borrow_datecheck = date('Ymd', strtotime($borrow_date));



$date = new DateTime();
$resultdate = $date->format('Y-m-d');

$check_date = new DateTime();
$check_date = $check_date->format('Ymd');


$check_date = $borrow_datecheck - $check_date;


echo $check_date;

?>