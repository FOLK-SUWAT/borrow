<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);

$id = $data->id;

$sql = "SELECT * FROM category WHERE type_id = $id";
    
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);
    
    
        $cat_name = $row["cat_name"];
    }

	if(@$cat_name != ''){
		$out['error'] = true;
		$out['message'] = 'ไม่สามารถลบได้ #มีข้อมูลที่เชื่อมต่อกันอยู่';

	
	}else{
		$sql = "DELETE FROM category_type WHERE id = '$id'";
			$query = $conn->query($sql);

			if ($query) {
				$out['message'] = 'Item deleted Successfully';
			} else {
				$out['error'] = true;
				$out['message'] = 'Cannot delete Item';
			}
	}


echo json_encode($out);
