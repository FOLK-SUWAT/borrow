<?php
include('conf.php');
$data = json_decode(file_get_contents("php://input"));

$out = array('error' => false, 'mem_name' => false, 'email' => false, 'department' => false, 'password' => false, 'mem_type_id' => false);

$mem_name = $data->mem_name;
$email = $data->email;
$department = $data->department;
$password = $data->password;
$mem_type_id = $data->mem_type_id;


if (empty($mem_name)) {
    $out['mem_name'] = true;
    $out['message'] = 'mem_name is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $out['email'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($department)) {
    $out['department'] = true;
    $out['message'] = 'department is required';
} elseif (empty($password)) {
    $out['password'] = true;
    $out['message'] = 'password is required';
} else {

    $mem_id = explode("-", $department);
    
    $sql = "INSERT INTO member (mem_name, email,department,password,mem_type_id) 
        VALUES ('$mem_name', '$email','$mem_id[0]', '$password', '$mem_type_id')";
    $query = $conn->query($sql);

    if ($query) {
        $out['message'] = 'Member Added Successfully';
    } else {
        $out['error'] = true;
        $out['message'] = 'Cannot Add Member';
    }
}

echo json_encode($out);
