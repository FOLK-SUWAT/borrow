<?php
include('conf.php');
session_start();

$borrow_bill = $_POST['borrow_bill'];


$sql = "UPDATE borrow_bill SET status_bill = 'รอการอนุมัติ' WHERE borrow_bill = '$borrow_bill'";
$query = $conn->query($sql);






    $records = array();
    $sql = "SELECT * FROM borrow WHERE borrow_id = '$borrow_bill'";
    $query = $conn->query($sql);
    $num_rows = mysqli_num_rows($query);

    while ($row = $query->fetch_array()) {
        $records[] = $row;
    }
    if (is_array($records)) {
    
        foreach ($records as $row) {
            $item_order = $row['item_order'];
            $amount = $row['amount'];
            $item_id = $row['item_id'];






            
            $query = "SELECT * FROM item WHERE item_id = '$item_id'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
            
                $in_use = $row["in_use"];
            }

            $in_use_amount= $in_use + $amount;


            $sql = "UPDATE item SET in_use = '$in_use_amount'WHERE item_id = '$item_id'";
            $query = $conn->query($sql);

          
            $sql = "UPDATE borrow SET amount = '0',status = 'รอการอนุมัติ' WHERE borrow_id = '$borrow_bill'";
            $query = $conn->query($sql);

        }
       

    }


echo 'ยกเลิก'.' '.'หมายเลขใบยืม :'.$borrow_bill. ' '.' เรียนร้อย';





?>
