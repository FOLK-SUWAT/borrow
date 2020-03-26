<?php
include('conf.php');
session_start();
$department =   $_SESSION["department"];
$data = json_decode(file_get_contents("php://input"));


$out = array(
    'error' => false,  'type_id' => false, 'type_name' => false
);








$type_id = $data->type_id;
$type_name = $data->type_name;


if (empty($type_id)) {
    $out['type_id'] = true;
    $out['message'] = 'type_id is required';
} elseif (empty($type_name)) {
    $out['type_name'] = true;
    $out['message'] = 'type_name is required';
} else {


    $sql = "INSERT INTO category_type ( type_id, type_name,mem_type_department) 
        VALUES ( '$type_id', '$type_name','$department')";
    $query = $conn->query($sql);

    if ($query) {
        $out['message'] = 'category Added Successfully';
    } else {
        $out['error'] = true;
        $out['message'] = 'Cannot Add category';
    }
}

echo json_encode($out);
