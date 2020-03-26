<?php
include('conf.php');
session_start();
$department =   $_SESSION["department"];


$output = array();
$sql = "SELECT * FROM category_type WHERE mem_type_department = '$department'";
$query = $conn->query($sql);
while ($row = $query->fetch_array()) {
	$output[] = $row;
}

echo json_encode($output);
