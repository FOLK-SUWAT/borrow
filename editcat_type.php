<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);
$id = $data->id;

$type_id = $data->type_id;
$type_name = $data->type_name;



$sql = "UPDATE category_type SET  type_id = '$type_id', type_name = '$type_name' WHERE id = '$id'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'category updated Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot update category';
}

echo json_encode($out);
