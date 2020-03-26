<?php
@include("conf.php");
session_start();
date_default_timezone_set('Asia/Bangkok');
?>

<?php
set_time_limit(0);
header('Content-Type: text/html; charset=utf-8');
 
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Report.xls"');#กำหนดชื่อไฟล์
echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">';
?>
<?php
if ($_POST["Printdate"] != null) {
  $YM = $_POST["Printdate"];
  $Y = substr($YM, 0, strpos($YM, "-"));
  $M = substr($YM, strpos($YM, "-") + 1);

  $rp_mem_id=$_POST["rp_mem_id"];


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



$depart = "SELECT * FROM borrow
INNER JOIN mem_type ON borrow.borrow_department=mem_type.mem_id
WHERE borrow.borrow_department = $rp_mem_id";

$resultdepart = mysqli_query($conn, $depart);
if($resultdepart !=null){
if (mysqli_num_rows($resultdepart) > 0) {
   $rowdepart = mysqli_fetch_array($resultdepart);

   $departmentmesg = $rowdepart["mem_type_department"];
}

  }
}
  //รายการใบยืมทั้งหมด 

  ?>






  <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>

  <body>
    <table>
      <tr>
        <th> </th>
        <th> </th>
        <th> <?php echo "<h5>" . $M . " - " . $Y . " แผนก " . $departmentmesg . "</h5>"; ?></th>
      </tr>
    </table>
    <table>
      <thead>
        <tr>
          <th>รายการใบยืมทั้งหมด </th>
          <th>จำนวนอุปกรณ์ที่ยืมทั้งหมด </th>
          <!--<th colspan="2" style="width:160px">Action</th>-->
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <center> <?php echo $num; ?></center>
          </td>
          <td>
            <center><?php echo $amount_all_row['sum_amount_all']; ?></center>
          </td>
        </tr>
      </tbody>
    </table>


    <?php
      //รายชื่ออุปกรณ์ที่ถูกยืม 



?>
      <table>
        <thead>
          <tr>
            <th><?php echo 'หมายเลขใบยืม' ?> </th>
            <th><?php echo 'รหัสอุปกรณ์' ?> </th>
            <th><?php echo 'ชื่ออุปกรณ์' ?> </th>
            <th><?php echo 'จำนวนที่ขอยืม' ?> </th>
            <th><?php echo 'จำนวนที่อนุมัติ' ?> </th>
            <th><?php echo 'จำนวนที่รับคืน' ?> </th>
            <th><?php echo 'ชื่อผู้ยืม' ?> </th>

            
            
          </tr>
        </thead>
        <tbody>


          <?php 
            if($rp_mem_id =='ALL'){

              $itemSQL = "SELECT  *  FROM borrow 
              INNER JOIN mem_type ON borrow.member_id=mem_type.mem_id
              WHERE MONTH(borrow_date) ='" . $M . "' AND YEAR(borrow_date) ='" . $Y . "' ";
              

              }else{
              
              $itemSQL = "SELECT  *  FROM borrow 
              INNER JOIN mem_type ON borrow.member_id=mem_type.mem_id
              WHERE MONTH(borrow_date) ='" . $M . "' AND YEAR(borrow_date) ='" . $Y . "' AND  borrow.borrow_department = $rp_mem_id ";
              

              }

              $itemSQL_list = mysqli_query($conn, $itemSQL);
              $item_num = mysqli_num_rows($itemSQL_list);
              for ($x = 0; $item_num > $x; $x++) {
                $item_row = mysqli_fetch_array($itemSQL_list);
                ?>
            <tr>

              
            <td><?php echo $item_row['borrow_id'] ?> </td>
            <td><?php echo $item_row['item_id'] ?> </td>
            <td><?php echo $item_row['item_name'] ?> </td>
            <td><?php echo $item_row['num_request'] ?> </td>
            <td><?php echo $item_row['amount'] ?> </td>
            <td><?php echo $item_row['num_sendback'] ?> </td>
            <td><?php echo $item_row['mem_name'] ?> </td>
            <td><?php echo $item_row['mem_type_department'] ?> </td>
            </tr>

        <tbody>
        <?php } ?>
    



        </tbody>
      </table>
  </body>

  </html>
<?php } ?>
