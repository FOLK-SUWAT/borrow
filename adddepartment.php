<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false, 'department' => false, 'line_token' => false);


$department = $data->department;
$line_token = $data->line_token;




if (empty($department)) {
    $out['department'] = true;
    $out['message'] = 'department is required';
} else {
    $sql = "INSERT INTO mem_type (mem_type_department,line_token) 
        VALUES ('$department','$line_token')";
    $query = $conn->query($sql);

    if ($query) {
        $out['message'] = 'Member Added Successfully';
    } else {
        $out['error'] = true;
        $out['message'] = 'Cannot Add Member';
    }
}

echo json_encode($out);
