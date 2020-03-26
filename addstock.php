<?php
@include("conf.php");
session_start();
date_default_timezone_set('Asia/Bangkok');
?>
<?php
if (@$_POST["borrow_bill"] != null) {
    $_SESSION["borrow_bill"] = $_POST["borrow_bill"];
} else {
    echo '<script language="javascript">';
    echo 'alert(ไม่พบข้อมูล bill)';
    echo '</script>';
}
?>
<?php //sqlละเอียดการยืม
$SQL_borrow_detail = "SELECT * FROM borrow_bill
    INNER JOIN member ON member.member_id=borrow_bill.member_id
    INNER JOIN mem_type ON mem_type.mem_id=member.department
    WHERE borrow_bill ='" . $_SESSION["borrow_bill"] . "'";
//แสดงรายละเอียดการยืม
$borrow_detail = mysqli_query($conn, $SQL_borrow_detail);
$row_borrow_detail = mysqli_fetch_array($borrow_detail);
?>
<html>
<!------------------------------------------------ HEADER ----------------------------------------------------------------->
<nav class="navbar navbar-expand navbar-expand-sm nav_body ">
    <?php @include('navbar.php') ?>
</nav>
<!-- sidebar -->
<nav class="navbar  navbar-expand-sm menu_body   ">
    <?php @include('sidebar.php') ?>
</nav>
<!--check content -->
<?php if (isset($_SESSION['mem_type_id'])) { ?>

    <body>
        <div class="container">
            <div class="row borrow_toppic">
                <div class="col-md-12 index_topic">
                    <center>
                        <h4>ใบยืมอุปกรณ์</h4>
                    </center>
                </div>
            </div>
            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-6  borrow_detail ">
                    <h6><b>หัวข้อการยืม</b> : <?php echo $row_borrow_detail['borrow_topic']; ?></h6>
                </div>
                <div class="col-md-6 borrow_detail">
                    <h6><b>รหัสใบยืม</b> : <?php echo $row_borrow_detail['borrow_bill']; ?></h6>
                </div>
            </div>
            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-6 borrow_detail">
                    <h6><b>ชื่อผู้ยืม</b> : <?php echo $row_borrow_detail['mem_name']; ?></h6>
                </div>
                <div class="col-md-6 borrow_detail">
                    <h6><b>แผนก</b> : <?php echo $row_borrow_detail['mem_type_department']; ?></h6>
                </div>
            </div>
            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-6 borrow_detail">
                    <h6><b>วันที่ต้องการยืม</b> : <?php echo $row_borrow_detail['borrow_date']; ?></h6>
                </div>
                <div class="col-md-6 borrow_detail">
                    <h6><b>วันที่คืน</b> : <?php echo $row_borrow_detail['return_date']; ?></h6>
                </div>
            </div>


            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-6 borrow_detail">
                    <h6><b>รายละเอียดการยืม</b> </h6>
                    <lable class="area" disabled rows="4" cols="135"><?php echo $row_borrow_detail['detail']; ?></lable>
                </div>
            </div>


            <div class="row">
                <table class="table table-bordered table-striped" style="margin-top:10px; text-align: center">
                    <thead>
                        <tr>
                            <th  class="text-center">ลำดับรายการ</th>
                            <th  class="text-center">รหัสอุปกรณ์</th>
                            <th  class="text-center">ชื่ออุปกรณ์</th>
                            <th  class="text-center">สถานะ</th>
                            <th  class="text-center">จำนวนที่ยืม</th>
                            <th  class="text-center">จำนวนที่ส่งคืน</th>
                            <th  class="text-center" style="width:160px">Action</th>
                            <th  class="text-center">ส่งคืน/จำนวนคืน</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- ตาราง ajax  -->
                        <?php @include('addstock_show.php') ?>
                        <?php @include('addstock_fetch.php') ?>

                    </tbody>
                </table>
            </div>
            <div class="row ">
                    <div class="col-1 row_btn_addstock">
                        <form method="post" name="form_save" id="form_save">
                            <input type="hidden" name="borrow_id" id="borrow_id" class="form-control" value="<?php echo $row_borrow_detail['borrow_bill']; ?>">
                            <input type="submit" name="save" id="save" class="btn btn-Send" value="บันทึกรายการ" />
                        </form>
                    </div>
                    <div class="col-2 row_btn_addstock" style="padding-left :70px" >
                        <input type="submit" class="btn btn-Send" data-toggle="modal" data-target="#modalForm" value="ส่งข้อความ" />
                    </div>

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
                            <a href="index.php" class="btn btn-primary align-items-center text-center "></div> กลับหน้าหลัก</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
<?php } ?>




<?php //sqlละเอียดการยืม
$SQLmsg = "SELECT * FROM member
    WHERE member_id= $row_borrow_detail[member_id]";
//แสดงรายละเอียดการยืม
$SQLmsg = mysqli_query($conn, $SQLmsg);
$SQLmsg = mysqli_fetch_array($SQLmsg);
?>


<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
				Close
                    <span aria-hidden="true">&times;

                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="inputName">ชื่อผู้ยืม</label>
                        <input type="text" class="form-control" id="inputName" placeholder=" <?php echo $SQLmsg['mem_name']; ?>" value="<?php echo $SQLmsg['mem_name']; ?>" disabled/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder=" <?php echo $SQLmsg['email']; ?>" value="  <?php echo $SQLmsg['email']; ?>"disabled/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">ข้อความ</label>
                        <textarea class="form-control" id="inputMessage" placeholder="Enter your message \ ใส่ข้อความ"></textarea>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">ส่งข้อความ</button>
            </div>
        </div>
    </div>
</div> 
</html>

<script>
function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var name = $('#inputName').val();
    var email = $('#inputEmail').val();
    var message = $('#inputMessage').val();
    if(name.trim() == '' ){
        alert('Please enter your name.');
        $('#inputName').focus();
        return false;
    }else if(email.trim() == '' ){
        alert('Please enter your email.');
        $('#inputEmail').focus();
        return false;
    }else if(email.trim() != '' && !reg.test(email)){
        alert('Please enter valid email.');
        $('#inputEmail').focus();
        return false;
    }else if(message.trim() == '' ){
        alert('Please enter your message.');
        $('#inputMessage').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'send_mail.php',
            data:'contactFrmSubmit=1&name='+name+'&email='+email+'&message='+message,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            
            success:function(msg){
                
                    $('#inputName').val('');
                    $('#inputEmail').val('');
                    $('#inputMessage').val('');
                    $('.statusMsg').html('<span style="color:green;">'+msg+'.</p>');
               
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>
<?php @include('filescript.php') ?>