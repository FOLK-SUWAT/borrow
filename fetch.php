<?php
	include('conf.php');
	
	$output = array();
	$sql = "SELECT * FROM member 
	INNER JOIN mem_type ON mem_type.mem_id=member.department ";
	$query=$conn->query($sql);
	while($row=$query->fetch_array()){
		$output[] = $row;
	}

	echo json_encode($output);
