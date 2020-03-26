<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false);

$mem_id = $data->mem_id;


$sql = "SELECT * FROM member WHERE mem_id = $mem_id";
    
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);
    
    
        $email = $row["email"];
    }




	if(@$email != ''){
	$out['error'] = true;
	$out['message'] = 'ไม่สามารถลบได้ #มีข้อมูลที่เชื่อมต่อกันอยู่';

}else{
	$sql = "DELETE FROM mem_type WHERE mem_id = '$mem_id'";
	$query = $conn->query($sql);
	
	if ($query) {
		$out['message'] = 'Department deleted Successfully';
	} else {
		$out['error'] = true;
		$out['message'] = 'Cannot delete department';
	}
}
	echo json_encode($out);

