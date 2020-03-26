<?php
include('conf.php');

$output = array();
$sql = "SELECT * FROM mem_type";
$query = $conn->query($sql);
while ($row = $query->fetch_array()) {
	$output[] = $row;
}

echo json_encode($output);
