<?php
$data = json_decode(file_get_contents("php://input"));
include('conf.php');


$out = array('error' => false);
$borrow_bill = $data->borrow_bill;
$borrow_topic = $data->borrow_topic;
$borrow_date = $data->borrow_date;
$return_date = $data->return_date;


$sql = "UPDATE borrow_bill SET borrow_topic = '$borrow_topic', borrow_date = '$borrow_date',
 return_date = '$return_date'WHERE borrow_bill = '$borrow_bill'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Item updated Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot update Item';
}

echo json_encode($out);
