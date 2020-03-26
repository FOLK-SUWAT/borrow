<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);

$item_order = $data->item_order;

$sql = "DELETE FROM borrowcart WHERE item_order = '$item_order'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Item deleted Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot delete Item';
}

echo json_encode($out);
