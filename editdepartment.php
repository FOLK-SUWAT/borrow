<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);
$mem_id = $data->mem_id;

$mem_type_department = $data->mem_type_department;
$line_token = $data->line_token;



$sql = "UPDATE mem_type SET mem_type_department = '$mem_type_department', line_token = '$line_token' WHERE mem_id = '$mem_id'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Member updated Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot update Member';
}

echo json_encode($out);
