<?php
session_start();
date_default_timezone_set('Asia/Bangkok');

include('conf.php');

$out = array('error' => true, 'num_request' => false);
$output = json_decode(file_get_contents("php://input"));
$data = json_decode(file_get_contents("php://input"));
$date = new DateTime();
$resultdate = $date->format('d-m-Y H:i:s');



$create_date = $resultdate;
@$borrow_topic = $data->borrow_topic;
$num_request = $data->num_request;
$amount = "";


@$borrow_date = $data->borrow_date;
@$return_date = $data->return_date;
$status = "รอการอนุมัติ";
$item_id = $data->item_id;
$item_name = $data->item_name;
$member_id =  $_SESSION["member_id"];
$mem_name =   $_SESSION["mem_name"];
$borrow_department = $data->department;
if (is_integer($num_request) ) {

    $sql = "INSERT INTO borrowcart (create_date,borrow_topic,num_request,amount,borrow_date,return_date,status,item_id,item_name,member_id,mem_name,borrow_department) 
    VALUES ('$create_date','$borrow_topic','$num_request','$amount','$borrow_date','$return_date','$status','$item_id','$item_name','$member_id','$mem_name','$borrow_department')";

    /*$sql = "INSERT INTO borrowcart (create_date,borrow_topic,num_request,amount,untit,detail,borrow_date,return_date,status,item_id,item_name,member_id,mem_name) 
    VALUES ('$create_date','$borrow_topic','$num_request','$amount','$unit','$detailborrow','$borrow_date','$return_date','$status','$item_id','$item_name','$member_id','$mem_name')";
    */
    $query = $conn->query($sql);



    if ($query) {
   

        $out = array();
        $sql = "SELECT * FROM item 
        INNER JOIN category_type ON item.type_id=category_type.id
        INNER JOIN category ON item.cat_id=category.id
        INNER JOIN mem_type ON item.department=mem_type.mem_id
        WHERE item.department = '$borrow_department'";
        
        
        $query = $conn->query($sql);
while ($row = $query->fetch_array()) {
    $value=$row['item_id'];
    $item_id=$row['item_id'];
    $item_name=$row['item_name'];
    $in_use=$row['in_use'];
    $detail = $row['detail'];
    $mem_type_department = $row['mem_type_department'];
    $picture = $row['picture'];
    $serail = $row['serail'];
    $department  = $row['department'];
    $num='0';
          $sql2="SELECT * FROM borrow WHERE item_id = $value AND status='รอการอนุมัติ' ";
          if ($res2 = mysqli_query($conn, $sql2)) { 
          if (mysqli_num_rows($res2) > 0) {
          while ($row = mysqli_fetch_array($res2)) { 
                                                            
                                                  
          $num_request = $row['num_request'];
          
          $num= $num + $num_request;
          }}}
    
  
    $out[] =  array(
        'item_id'=> $item_id,
        'item_name'=> $item_name,
        'in_use'=>$in_use,
        'Reservations'=>$num,
        'detail'=>$detail,
        'mem_type_department'=>$mem_type_department,
        'picture'=>$picture,
        'serail'=>$serail,
        'department'=>$department,
    );
  
    @$num='';
  
  
}
    
    













        
    } 



}else {

    $out['error'] = true;
    $out['message'] = 'ต้องการจำนวน/เลขจำนวนเต็วเท่านั่น';
}





echo json_encode($out);
