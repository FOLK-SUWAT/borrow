<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);
$id = $data->id;
$cat_id = $data->cat_id;
$cat_name = $data->cat_name;



$sql = "UPDATE category SET cat_id = '$cat_id', cat_name = '$cat_name' WHERE id = '$id'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'category updated Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot update category';
}

echo json_encode($out);
