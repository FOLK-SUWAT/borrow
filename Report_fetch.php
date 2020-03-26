<?php // include'conf.php'
include('conf.php');
session_start(); ?>
<?php
if ($_POST["Ddate"] != null ) {
    $YM = $_POST["Ddate"];
    $Y = substr($YM, 0, strpos($YM, "-"));
    $M = substr($YM, strpos($YM, "-") + 1);
 
    $rp_mem_id=$_POST["rp_mem_id"];

    
    //รายชื่ออุปกรณ์ที่ถูกยืม 
 if($rp_mem_id =='ALL'){

    $records = array();
    $sql = "SELECT  *  FROM borrow 
    INNER JOIN member ON borrow.member_id=member.member_id
    INNER JOIN mem_type ON member.department=mem_type.mem_id
    INNER JOIN item ON borrow.item_id=item.item_id
    WHERE MONTH(borrow_date) ='" . $M . "' AND YEAR(borrow_date) ='" . $Y . "' ";
    
    $query = $conn->query($sql);
 }else{

    $records = array();
    $sql = "SELECT  *  FROM borrow 
       INNER JOIN member ON borrow.member_id=member.member_id
    INNER JOIN mem_type ON member.department=mem_type.mem_id
    INNER JOIN item ON borrow.item_id=item.item_id

    WHERE MONTH(borrow_date) ='" . $M . "' AND YEAR(borrow_date) ='" . $Y . "' AND  borrow.borrow_department = $rp_mem_id ";
    
    $query = $conn->query($sql);


  
 }






    while ($row = $query->fetch_array()) {
        $records[] = $row;
    }
    if (is_array($records)) {
    
        foreach ($records as $row) {?>

        <tr>
            <td><?php echo $row['borrow_id'] ?> </td>
            <td><?php echo $row['serail'] ?> </td>
            <td><?php echo $row['item_name'] ?> </td>
            <td><?php echo $row['num_request'] ?> </td>
            <td><?php echo $row['amount'] ?> </td>
            <td><?php echo $row['num_sendback'] ?> </td>
            <td><?php echo $row['borrow_date'] ?> </td>
            <td><?php echo $row['return_date'] ?> </td>
            <td><?php echo $row['mem_name'] ?> </td>
            <td><?php echo $row['mem_type_department'] ?> </td>
            
        </tr>

        <?php
        }
    }





        

    } echo $billSQL;?>