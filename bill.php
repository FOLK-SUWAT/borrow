<?php
@include("conf.php");
session_start();
date_default_timezone_set('Asia/Bangkok');
@$borrow_bill = @$_POST["borrow_bill"];
?>


<html>
<!------------------------------------------------ HEADER ----------------------------------------------------------------->
<nav class="navbar navbar-expand navbar-expand-sm nav_body ">
    <?php @include('navbar.php') ?>
</nav>
<!-- sidebar -->
<nav class="navbar  navbar-expand-sm  menu_body ">
    <?php @include('sidebar.php') ?>
</nav>
<!--check content -->
<?php if (isset($_SESSION['mem_type_id'])) { ?>
    <!-- content -->
    <!------------------------------------------------ BODY ----------------------------------------------------------------->

    <body>
        <div class="container">
            <div class="row row_topic_bill">
                <div class="col-md-4">
                    <h1 class="index_topic">รายการใบยืมอุปกรณ์</h1>
                </div>
                <div class="col-md-4 row_search">
                    <input type="text" name="search_text" id="search_text" placeholder="ค้นหาหมายเลขใบยืม" class="form-control textbox_search" />
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered table-striped" style="margin-top:10px; text-align: center">
                    <thead>
                        <tr>
                            <th class="text-center">หมายเลขใบยืม</th>
                            <th class="text-center">หัวข้องานที่ยืม</th>
                            <th class="text-center">ผู้ยืม</th>
                            <th class="text-center">แผนก</th>
                            <th class="text-center">วันที่ต้องการยืม</th>
                            <th class="text-center">วันที่ส่งคืน</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="result">
                    </tbody>

                </table>
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

<script>
    $(document).ready(function() {
        var on = 1;
        $.ajax({
            url: 'bill_fetch.php',
            method: "post",
            data: {
                load: on
            },
            dataType: "text",
            success: function(data) {
                $('#result').html(data);
            }
        });

        $('#search_text').keyup(function() {
            var txt = $(this).val();
            $('#result').html('');
            $.ajax({
                url: 'bill_fetch.php',
                method: "post",
                data: {
                    search: txt
                },
                dataType: "text",
                success: function(data) {
                    $('#result').html(data);
                }
            });

        });


    });




    

    

</script>


