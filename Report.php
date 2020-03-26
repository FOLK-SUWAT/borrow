<?php
@include("conf.php");
session_start();
date_default_timezone_set('Asia/Bangkok');

@$rp_id = '';
$query = "SELECT * FROM mem_type ";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {
	$rp_id .= '<option value="'. $row["mem_id"] .'">' . $row["mem_type_department"] . '</option>';
}


?>
<nav class="navbar navbar-expand navbar-expand-sm nav_body ">
  <?php @include('navbar.php') ?>
</nav>
<!-- sidebar -->
<nav class="navbar  navbar-expand-sm menu_body ">
  <?php @include('sidebar.php') ?>
</nav>
<?php if (isset($_SESSION['mem_type_id'])) { ?>

  <body>
    <div class="container">
      <div class="row row_report">
        <div class="col-md-5">
          <h1 class="index_topic">รายงานการยืมอุปกรณ์</h1>
        </div>
        <div class="col-md-6 row_search">
          <form method="post" action="" name="Ddate_form" id="Ddate_form">
            <div class="input-group">
              <label class="text_select"><b>เลือกแผนก/เดือน</b></label>
              <select name="rp_mem_id" id="rp_mem_id" class="form-control action">
                          <option value='ALL'>ทุกแผนก</option>
                          <?php echo $rp_id;  ?>
              </select>

                  <input type="month" name="Ddate" value="" class="form-control" />
              </div>

        </div>
        <div class="col-md-1 row_btn">
          <input type="submit" class="btn btn-Send" name="MONTH_btn" value="ค้นหา" class="form-control" />
          </form>
        </div>

      </div>
      <div class="row row_report">

      </div>

      <!--ตารางแสดงข้อมูล-->
      <div class="row" style="padding-top:50px">
        <?php
          @$YM = $_POST["Ddate"];
          $Y = substr($YM, 0, strpos($YM, "-"));
          $M = substr($YM, strpos($YM, "-") + 1);
          $_SESSION['ym'] =$YM;
          ?>
          
        <h5 style="padding-right :10px"> รายการใบยืมอุปกรณ์เดือน</h5>
        <?php 
          @$rp_mem_id=$_POST["rp_mem_id"];
        if($rp_mem_id =='ALL'){

        }else{
       
       $depart = "SELECT * FROM borrow
       INNER JOIN mem_type ON borrow.borrow_department=mem_type.mem_id
       WHERE borrow.borrow_department = $rp_mem_id";
       
       $resultdepart = mysqli_query($conn, $depart);
       if($resultdepart !=null){
       if (mysqli_num_rows($resultdepart) > 0) {
           $rowdepart = mysqli_fetch_array($resultdepart);
       
           $departmentmesg = $rowdepart["mem_type_department"];
       
       }}
       }
        
        
        echo "<h5>" . $M . " - " . $Y . " แผนก " . @$departmentmesg."</h5>"; ?>
        <table class="table table-bordered table-striped" style="margin-top:0px; text-align: center">
          <thead>
            <tr>
              <th>รายการใบยืมทั้งหมด</th>
              <th>จำนวนอุปกรณ์ที่อนุมัติทัั้งหมด</th>
              <!--<th colspan="2" style="width:160px">Action</th>-->
            </tr>
          </thead>
          <tbody>
            <?php @include('Report_All.php') ?>
          </tbody>
        </table>
      </div>
      <div class="row" style="padding-top:50px">
        <h5 style="padding-right :10px"> รายการอุปกรณ์ที่ถูกยืม</h5>
        <table class="table table-bordered table-striped" style="margin-top:0px; text-align: center">

        <tr>
            <th><?php echo 'หมายเลขใบยืม' ?> </th>
            <th><?php echo 'รหัสอุปกรณ์' ?> </th>
            <th><?php echo 'ชื่ออุปกรณ์' ?> </th>
            <th><?php echo 'จำนวนที่ขอยืม' ?> </th>
            <th><?php echo 'จำนวนที่อนุมัติ' ?> </th>
            <th><?php echo 'จำนวนที่รับคืน' ?> </th>
            <th><?php echo 'วันที่ยืม' ?> </th>
            <th><?php echo 'วันที่ส่งคืน	' ?> </th>
            <th><?php echo 'ชื่อผู้ยืม' ?> </th>
            <th><?php echo 'แผนผู้ยืม' ?> </th>
        </tr>
          <tbody>
            
            <?php @include('Report_fetch.php') ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <form method="post" action="report_excel_php.php" name="Printdate_form" id="Printdate_form">
          <input type="hidden" name="Printdate" value="<?php echo $YM ?>" class="form-control" />
          <input type="hidden" name="rp_mem_id" value="<?php echo $rp_mem_id ?>" class="form-control" />
          <input type="submit" class="btn btn-Send" name="Print_btn" value="Print" class="form-control" />
        </form>
      </div>
    </div>

  </body>

<?php } else { ?>
  <div id="content-wrapper">
    <div class="container-fluid">
      <div>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">&nbsp;ไม่มีสิทธิ์เข้าถึงข้อมูล</h2>
            </div>
            <div class="modal-body center-block align-content-center">
              <a href="index.php" class="btn btn-primary align-items-center text-center "></i> กลับหน้าหลัก</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
<?php } ?>

</html>
<?php @include('filescript.php') ?>