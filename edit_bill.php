<?php
include("conf.php");
include("alert_line.php");
session_start();

?>
    
<?php

$_SESSION["borrow_edit_bill"] =@ $_POST["borrow_bill"];


$SQLcart="SELECT * FROM borrow WHERE borrow_id='" . $_SESSION["borrow_edit_bill"] . "'";
$result = @$conn->query($SQLcart);
//sqlละเอียดการยืม
$SQL_borrow_detail = "SELECT * FROM borrow_bill
    INNER JOIN mem_type ON mem_type.mem_id=borrow_bill.borrow_department

    WHERE borrow_bill='" . $_SESSION["borrow_edit_bill"] . "'";
//แสดงรายละเอียดการยืม
$borrow_detail = mysqli_query($conn, $SQL_borrow_detail);
$row_borrow_detail = mysqli_fetch_array($borrow_detail);




?>

<!DOCTYPE html>
<html lang="th" >



<body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand navbar-expand-sm nav_body ">
        <?php @include('navbar.php') ?>
    </nav>
    <!-- sidebar -->


    <nav class="navbar  navbar-expand-sm menu_body   ">
        <?php @include('sidebar.php') ?>
    </nav>

    <div id="wrapper">

<!--check content  login -->
        <?php if(!isset($_SESSION['mem_type_id'])) { ?>

                <div id="content-wrapper">
                    <div class="container-fluid">
                        <div>
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header ">
                                        <h2 class="modal-title">&nbsp;Login</h2>
                                    </div><center>
                                    <div class='form '><span style='color:red;'>
                                    <?php echo @$_SESSION['Unsuccess'];  ?>
                                    </span></div></center>


                                    <div class="form modal-body">
                                                <form action="index.php" method="post" name="login">
                                                    <input type="text" name="email" class="form-control" placeholder="email" required />
                                                    <br />
                                                    <input type="password" name="password" class="form-control" placeholder="password" required />
                                                    <br />
                                                    <input name="submit" type="submit" class="btn btn-primary submitBtn" value="Login" />
                                                </form>
                                    </div>
                                            
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



        <!--content -->
        <?php }else if (isset($_SESSION['mem_type_id'])) { ?>

       

    <body>
        <div class="container">
      
        <form id="ins_save">
            <div class="row borrow_toppic">
                <div class="col-md-12 index_topic">
                    <center>
                        <h4>ใบยืมอุปกรณ์</h4>
                    </center>
                </div>
            </div>
            <div class="col-md-2 row_btn ">
                                    <a  href="index.php"> กลับหน้าหลัก </a>
                                
                                </div>
            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-6  borrow_detail ">
                    <h6><b>หัวข้อการยืม</b> : <input type="text" value="<?php echo $row_borrow_detail['borrow_topic']; ?>" placeholder="<?php echo $row_borrow_detail['borrow_topic']; ?>" id="borrow_topic" name="borrow_topic"></h6>
                </div>
                <div class="col-md-6 borrow_detail">
                    <h6><b>รหัสใบยืม</b> : <?php echo $row_borrow_detail['borrow_bill']; ?></h6>
                    <input type="hidden" value="<?php echo $row_borrow_detail['borrow_bill']; ?>"  id="borrow_bill" name="borrow_bill">
                </div>
            </div>
            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-6 borrow_detail">
                    <h6><b>ชื่อผู้ยืม</b> : <?php echo $row_borrow_detail['mem_name']; ?></h6>
                </div>
                <div class="col-md-6 borrow_detail">
                    <h6><b>ยืมแผนก</b> : <?php echo $row_borrow_detail['mem_type_department']; ?></h6>
                </div>
            </div>
            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-6 borrow_detail">
                    <h6><b>วันที่ต้องการยืม</b> :
                    <input type="text" value="<?php echo $row_borrow_detail['borrow_date']; ?>"  placeholder="  <?php echo $row_borrow_detail['borrow_date']; ?>" id="borrow_date" name="borrow_date"> </h6>
                </div>
                <div class="col-md-6 borrow_detail">
                    <h6><b>วันที่คืน</b> : 
                    <input type="tesxt" value="<?php echo $row_borrow_detail['return_date']; ?>"  placeholder=" <?php echo $row_borrow_detail['return_date']; ?>" id="return_date" name="return_date"></h6>
                </div>
            </div>
            <div class=" row" style="margin-bottom: 25px;">
                <div class="col-md-12 borrow_detail">
                <h6><b>รายละเอียดการยืม</b>  </h6>
                <input type="text" value="<?php echo $row_borrow_detail['detail']; ?>" placeholder=" <?php echo $row_borrow_detail['detail']; ?>" id="detail" name="detail">
                </div>
            </div>
            <button type="submit" class="btn btn-primary submitBtn" >บันทึกข้อมูลใบยืมอุปกรณ์</button><p class="statusMsg"></p>

        </form>

            <div class="row">
                <table class="table table-bordered table-striped" style="margin-top:10px; text-align: center">
                    <thead>
                        <tr>
                            <th  class="text-center">ลำดับรายการ</th>
                            <th  class="text-center">ชื่ออุปกรณ์</th>
                            <th  class="text-center">สถานะ</th>
                            <th  class="text-center">จำนวนที่ต้องการยืม</th>
                            <th  class="text-center" colspan="2" style="width:160px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ตาราง ajax  -->
                        <?php

                            if(@$result->num_rows > 0){
                            while($row=$result->fetch_assoc()){
                                @$num = $num+1;
                            ?>
                          
                            <tr>
                                <td><?php echo $num ?> </td>
                                <td><?php echo $row['item_name'] ?> </td>
                                <td style="color:#FFC300"><?php echo $row['status'] ?> </td>
                                <td>
                                            <center> <input type="text" name="<?php echo $row['item_order']; ?>" id="<?php echo $row['item_order']; ?>" class="form-control action" value="<?php echo $row['num_request']; ?>" style="width: 80px "></center>
                                </td>
                                <td>
                                    <form id="ins_delete">
                                        <input type="text" value="<?php echo $row['item_order']; ?>" id="delete_item" name="delete_item" hidden>
                                        <button type="submit" class="btn btn-danger submitBtn" >ลบรายการ</button> 
                                </td>
                            </tr>
                         
                            <?php }} ?> 


                        
                        <?php @include('edit_bill_fetch.php') ?>
                        
                    </tbody>
                </table>
               
                
               
            </div>

    </body>

            
        <?php } ?>
  



                                      

</body>




<?php @include('filescript.php') ?>
</html>

<script type="text/javascript">
	$('#ins_save').on("submit", function(e) {
		e.preventDefault();
		$.ajax({

			type: 'POST',
			url: 'edit_bill_fetch.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
                if(data == 'update_bill'){
                    alert("อัพเดตเรียบร้อย");
                }
			}
		});

    });

    $('#ins_delete').on("submit", function(e) {
		e.preventDefault();
		$.ajax({

			type: 'POST',
			url: 'edit_bill_fetch.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
                if(data == 'delete_item'){
                    location.reload();
                }

			}
		});

    });

$(document).ready(function() {

        $('.action').change(function() {
            if ($(this).val() != '') {
                var action = $(this).attr("id");
                var query = $(this).val();
            
                var result = '';
                if (action == "num_request") {
                }
                $.ajax({
                    url: "edit_bill_fetch.php",
                    method: "POST",
                    data: {
                        action: action,
                        query: query,
                    
                    },
                    success: function(data) {
                        
                    }
                })
            }
        });



});  

</script>