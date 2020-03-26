<?php
include('conf.php');
session_start();

$data = json_decode(file_get_contents("php://input"));

$content = $data->content;


$output = array();
$sql = "SELECT * FROM item 
    INNER JOIN category_type ON item.type_id=category_type.id
    INNER JOIN category ON item.cat_id=category.id
	INNER JOIN mem_type ON item.department=mem_type.mem_id
    WHERE item.department =$content ";


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
    
  
    $output[] =  array(
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

echo json_encode($output);


/*  เลือกแสดงเป็นแผนก   WHERE mem_type.mem_id =$content ";*/

/*$sql = "SELECT * FROM category_type INNER JOIN item ON item.type_id=category_type.type_id";   = '$_POST[data_type]'*/
