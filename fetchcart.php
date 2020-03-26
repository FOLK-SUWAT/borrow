<?php
include('conf.php');
session_start();

$output = array();
$sql = "SELECT * FROM borrowcart WHERE member_id = '$_SESSION[member_id]'";
$query = $conn->query($sql);
while ($row = $query->fetch_array()) {
	$output[] = $row;

	
}




echo json_encode($output);
