<?php // include'conf.php'
include('conf.php');
session_start(); ?>
<?php
if ($_POST["Ddate"] != null) {
        $YM = $_POST["Ddate"];
    $Y = substr($YM, 0, strpos($YM, "-"));
    $M = substr($YM, strpos($YM, "-") + 1);
    $rp_mem_id=$_POST["rp_mem_id"];
}
?>
<?php
//รายการใบยืมทั้งหมด 

if($rp_mem_id =='ALL'){

    $listSQL = "SELECT * FROM borrow_bill 
    WHERE MONTH(borrow_date) ='" . $M . "' AND YEAR(borrow_date) ='" . $Y . "' ";
    $listSQL_list = mysqli_query($conn, $listSQL);
    $num = mysqli_num_rows($listSQL_list); 
    
    
    //จำนวนที่อนุมัติทั้งหมด
    $amount_allSQL = "SELECT SUM(amount) AS sum_amount_all FROM borrow
    WHERE MONTH(borrow_date) ='" . $M . "'
    AND YEAR(borrow_date) ='" . $Y . "' ";
    $amount_all_query = mysqli_query($conn, $amount_allSQL);
    $amount_all_row = mysqli_fetch_array($amount_all_query);
    

}else{

$listSQL = "SELECT * FROM borrow_bill 
WHERE MONTH(borrow_date) ='" . $M . "' AND YEAR(borrow_date) ='" . $Y . "' AND  borrow_department =$rp_mem_id ";
$listSQL_list = mysqli_query($conn, $listSQL);
$num = mysqli_num_rows($listSQL_list); 


//จำนวนที่อนุมัติทั้งหมด
$amount_allSQL = "SELECT SUM(amount) AS sum_amount_all FROM borrow
WHERE MONTH(borrow_date) ='" . $M . "'
AND YEAR(borrow_date) ='" . $Y . "' 
AND  borrow_department =$rp_mem_id";
$amount_all_query = mysqli_query($conn, $amount_allSQL);
$amount_all_row = mysqli_fetch_array($amount_all_query);

}
?>

<td> <?php echo $num; ?></td>
<td> <?php echo $amount_all_row['sum_amount_all']; ?></td>
