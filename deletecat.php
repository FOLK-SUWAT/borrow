<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);

$id = $data->id;
$cat_name= $data->cat_name;


$sql = "SELECT * FROM item WHERE cat_id = $id";
    
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);
    
    
        $item_name = $row["item_name"];
	}
	
if(@$item_name != ''){
		$out['error'] = true;
		$out['message'] = 'ไม่สามารถลบได้ #มีข้อมูลที่เชื่อมต่อกันอยู่';
	
}else{

$sqli = "DELETE FROM category WHERE id = '$id'";
$query = $conn->query($sqli);

if ($query) {
	$out['message'] = $cat_name;
} else {
	$out['error'] = true;
	$out['message'] = 'Cannot delete Item';
}
}

echo json_encode($out);
