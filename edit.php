<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);
$member_id = $data->member_id;
$mem_name = $data->mem_name;
$email = $data->email;
$department = $data->department;
$password = $data->password;
$mem_type_id = $data->mem_type_id;


$sql = "UPDATE member SET mem_name = '$mem_name', email = '$email', department = '$department',
 password = '$password', mem_type_id = '$mem_type_id'  WHERE member_id = '$member_id'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Member updated Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot update Member';
}

echo json_encode($out);
