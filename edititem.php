<?php
date_default_timezone_set('Asia/Bangkok');
include('conf.php');
$data = json_decode(file_get_contents("php://input"));
$date = new DateTime();
$resultdate = $date->format('Y-m-d H:i:s');






$out = array('error' => false);
$item_id = $data->item_id;
$item_name = $data->item_name;
$detail = $data->detail;
$serail = $data->serail;
$create_date = $resultdate;
@$cat_idedit = $data->cat_idedit;
if(isset($cat_idedit)){
	$cat_id = $data->cat_idedit;

}else{
	$cat_id = $data->id;

}


$type_id = $data->type_id;
$in_use = $data->in_use;
$department = $data->department;
$sql = "UPDATE item SET item_name = '$item_name', detail = '$detail',
 serail = '$serail', create_date = '$create_date', cat_id = '$cat_id', type_id = '$type_id',
 in_use = '$in_use', department = '$department' WHERE item_id = '$item_id'";
$query = $conn->query($sql);

if ($query) {
	$out['message'] = 'Item updated Successfully';
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot update Item';
}

echo json_encode($out);
