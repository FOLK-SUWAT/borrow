<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include('conf.php');

$member_id =  $_SESSION['member_id'];
$mem_name =   $_SESSION['mem_name'];
$department =  $_SESSION['department'];

$borrow_topic = $_POST['borrow_topic'];
$borrow_date = $_POST['borrow_date'];
$return_date = $_POST['return_date'];
@$detail = $_POST['detail'];

$borrow_date =  $borrow_date;
$borrow_date = str_replace('-', '/', $borrow_date);
$borrow_date = date('Y-m-d h:i', strtotime($borrow_date));

$borrow_datecheck = date('Ymd', strtotime($borrow_date));

$return_date =  $return_date;
$return_date = str_replace('-', '/', $return_date);
$return_date = date('Y-m-d h:i', strtotime($return_date));

$date = new DateTime();
$resultdate = $date->format('Y-m-d');

$check_date = new DateTime();
$check_date = $check_date->format('Ymd');


$check_date = $borrow_datecheck - $check_date;

if($borrow_topic == ''){
    echo "อัพเดตไม่สำเร็จ กรุณากรอกหัวข้อการยืม:";

}elseif($return_date == ''){

    echo "อัพเดตไม่สำเร็จ กรุณากรอกวันที่ต้องคืน::";

}elseif( $borrow_date == ''){

    echo "อัพเดตไม่สำเร็จ กรุณากรอกวันที่ต้องการยืม:";

}elseif( $check_date < -2){

    echo "ยืมย้อนหลังได้ไม่เกิน2วัน";

}else {



$create_date = $date->format('Y-m-d h:i');

$sqlbill = "SELECT * FROM borrow_bill";
$querybill = $conn->query($sqlbill);

if($querybill != null){
while ($row = $querybill->fetch_array()) {
    $recordsbill[] = $row;
}

if (is_array($recordsbill)) {

    foreach ($recordsbill as $row) {
        $borrow_bill = $row['borrow_bill'];

    }
}

$borrow_bill = substr($borrow_bill,8);
$borrow_bill = $borrow_bill+1;
$datebill = new DateTime();
$dayBill = $datebill->format('dmY');
$randomBill = $dayBill.$borrow_bill;

}
    
    $borrow_topic;
    $item_order;
    $achack;
    
    
    $status_bill = 'รอการอนุมัติ';

        $sqlqq = "INSERT INTO borrow_bill (member_id, mem_name,create_date,borrow_bill,status_bill,borrow_date,return_date,borrow_topic,detail,borrow_department) 
        VALUES ('$member_id', '$mem_name','$create_date','$randomBill','$status_bill','$borrow_date','$return_date','$borrow_topic','$detail','')";
                $query = $conn->query($sqlqq);


    $records = array();
    $sql = "SELECT * FROM borrowcart WHERE member_id = '$_SESSION[member_id]'";
    $query = $conn->query($sql);
    $num_rows = mysqli_num_rows($query);

    while ($row = $query->fetch_array()) {
        $records[] = $row;
    }
    if (is_array($records)) {
    
        foreach ($records as $row) {
            $item_order = $row['item_order'];
            $create_date = $row['create_date'];
            $borrow_topic;
            $num_request = $row['num_request'];
            $amount = $row['amount'];
           
    
            $status = $row['status'];
            $item_id = $row['item_id'];
            $item_name = $row['item_name'];
            $member_id =  $row['member_id'];
            $mem_name =   $row['mem_name'];
            $borrow_department =  $row['borrow_department'];

                $query = "INSERT INTO borrow (borrow_id,borrow_topic,num_request,amount,borrow_date,return_date,status,item_id,item_name,member_id,mem_name,borrow_department) 
            VALUES ('$randomBill','$borrow_topic','$num_request','$amount','$borrow_date','$return_date','$status','$item_id','$item_name','$member_id','$mem_name','$borrow_department')";
                    $query = $conn->query($query);

            
        }
    }
    
            $sql = "UPDATE borrow_bill SET borrow_department = '$borrow_department'  WHERE borrow_bill = '$randomBill'";
        $query = $conn->query($sql);
   
        $sql = "DELETE FROM borrowcart WHERE member_id = $member_id";
        mysqli_query($conn, $sql);
    

    
    
    $query = "SELECT * FROM borrow
    INNER JOIN item ON item.item_id=borrow.item_id
    WHERE borrow_id= $randomBill";
    
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    
        $departmentmesg = $row["department"];
    }
    
    
    $borrow_topic;

    $departmentmesg =  $departmentmesg;
    
    
    
    
    $query = "SELECT * FROM  mem_type WHERE mem_id = '$departmentmesg'";
    
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    
        $line_token = $row['line_token'];
        $mem_type_department = $row['mem_type_department'];
    }
    
    
    $mesg =  $randomBill;
    
    
    
    
    
    if ($borrow_topic != null and $return_date != null and $borrow_date!= null and $detail!= null  and !empty($item_order)) {
    
    
    
      
    
    
    
    $sToken =   $line_token;
    $sMessage = "\n"  . 'เลขที่ใบยืม: ' .  $mesg .
        "\n"  . 'รวม: ' .  $num_rows . ' รายการ: ' .
        "\n" . 'แผนกที่ยืม: ' . $mem_type_department .
        "\n" . 'ชื่อผู้ยืม: ' . $mem_name .
        "\n" . 'เว็บ: ' . "http://10.31.8.21/borrow" .
        "\n" . 'วันที่ยืม: ' . $borrow_date .
        "\n" . 'วันกำหนดคืน: ' . $return_date .
        "\n";
    
                    
                    $chOne = curl_init(); 
                    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                    curl_setopt( $chOne, CURLOPT_POST, 1); 
                    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
                    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
                    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                    $result = curl_exec( $chOne ); 




                    
    }
    
    
    
    
    
    
    $query = $conn->query($sql);
    
    

   echo "อัพเดตสำเร็จ";
 

}

