<?php
include_once("conf.php");
if (isset($_POST['email_name']) && $_POST['email_name'] != '') {
    $response = array();
    $useremail = mysqli_real_escape_string($conn, $_POST['email_name']);
    $sql  = "select * from member where email='" . $useremail . "'";
    $res    = mysqli_query($conn, $sql);
    $count  = mysqli_num_rows($res);
    if ($count > 0) {
        $response['status'] = false;
        $response['msg'] = 'มีบุคคลอื่นใช้อีเมลแอดเดรสนี้แล้ว ให้ลองชื่ออื่น';
    } else {
        $response['status'] = false;
        $response['msg'] = '';
    }
    echo json_encode($response);
}
