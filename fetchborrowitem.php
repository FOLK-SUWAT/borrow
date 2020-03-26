<?php
include('conf.php');

$output = array();
$sql = "SELECT * FROM category_type 
INNER JOIN item ON item.type_id=category_type.type_id";
$query = $conn->query($sql);
while ($row = $query->fetch_array()) {
	$output[] = $row;
}

echo json_encode($output);
