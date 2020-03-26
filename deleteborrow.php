<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);

$borrow_id = $data->borrow_id;
$id = $data->borrow_bill;

$sql = "DELETE FROM borrow_bill WHERE borrow_id = '$borrow_id'";
$query = $conn->query($sql);


$sql = "DELETE FROM borrow WHERE borrow_id = '$id'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Item deleted Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot delete Item';
}



echo json_encode($out);
