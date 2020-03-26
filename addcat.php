<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));
session_start();
$department =   $_SESSION["department"];

$out = array('error' => false, 'cat_id' => false, 'cat_name' => false, 'type_id' => false);

$cat_id = $data->cat_id;
$cat_name = $data->cat_name;
$type_id = $data->type_id;


if (empty($cat_id)) {
    $out['cat_id'] = true;
    $out['message'] = 'cat_id is required';
} elseif (empty($cat_name)) {
    $out['cat_name'] = true;
    $out['message'] = 'cat_name is required';
}elseif (empty($type_id)) {
    $out['type_id'] = true;
    $out['message'] = 'type_id is required';
}  else {
    $sql = "INSERT INTO category (cat_id, cat_name,type_id,mem_type_department) 
        VALUES ('$cat_id', '$cat_name','$type_id','$department')";
    $query = $conn->query($sql);

    if ($query) {
        $out['message'] = 'เพิ่ม หมวดหมู่ เรียนร้อย ';
    } else {
        $out['error'] = true;
        $out['message'] = 'เพิ่ม หมวดหมู่ ไม่สำเร็จ';
    }
}

echo json_encode($out);
