<?php
@include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$id = $data->borrow_id;




$output = array();
$sql = "SELECT * FROM borrow
WHERE borrow.borrow_id= '$id'";
$query = $conn->query($sql);
while ($row = $query->fetch_array()) {
	$output[] = $row;
}

echo json_encode($output);
