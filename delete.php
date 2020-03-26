<?php
	include('conf.php');
    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false);

    $member_id = $data->member_id;

   	$sql = "DELETE FROM member WHERE member_id = '$member_id'";
   	$query = $conn->query($sql);

   	if($query){
   		$out['message'] = 'Member deleted Successfully';
   	}
   	else{
   		$out['error'] = true;
   		$out['message'] = 'Cannot delete Member';
   	}

    echo json_encode($out);
