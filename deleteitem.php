<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);

$item_id = $data->item_id;

$sql = "DELETE FROM item WHERE item_id = '$item_id'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Item deleted Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot delete Item';
}

echo json_encode($out);
