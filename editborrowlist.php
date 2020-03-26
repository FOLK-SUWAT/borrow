<?php
$data = json_decode(file_get_contents("php://input"));
include('conf.php');


$out = array('error' => false);

$item_order = $data->item_order;

$create_date = $data->create_date;
$borrow_topic = $data->borrow_topic;
$num_request = $data->num_request;
$amount = $data->amount;
$unit = $data->unit;
$borrow_date = $data->borrow_date;
$return_date = $data->return_date;
$status = $data->status;
$item_id = $data->item_id;
$item_name = $data->item_name;
$member_id =  $data->member_id;
$mem_name =   $data->mem_name;

$sql = "UPDATE borrow SET create_date = '$create_date', borrow_topic = '$borrow_topic',
 num_request = '$num_request', amount = '$amount', unit = '$unit',
 borrow_date = '$borrow_date' , return_date = '$return_date' , status = '$status', 
 item_id = '$item_id' , item_name = '$item_name' , member_id = '$member_id' , mem_name = '$mem_name' WHERE item_order = '$item_order'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Item updated Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot update Item';
}

echo json_encode($out);
