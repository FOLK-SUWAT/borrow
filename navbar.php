<?php
@include("conf.php");
?>
<!--add item borrow-->
<?php
session_start();





?>


<head>
    <meta charset="utf-8">



    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="style.css">


    <link rel="stylesheet" type="text/css" href="Bootstrap-4-4.1.1/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.18/css/dataTables.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="AutoFill-2.3.3/css/autoFill.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="Buttons-1.5.6/css/buttons.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="ColReorder-1.5.0/css/colReorder.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="FixedColumns-3.2.5/css/fixedColumns.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="FixedHeader-3.1.4/css/fixedHeader.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="KeyTable-2.5.0/css/keyTable.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="Responsive-2.2.2/css/responsive.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="RowGroup-1.1.0/css/rowGroup.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="RowReorder-1.2.4/css/rowReorder.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="Scroller-2.0.0/css/scroller.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="Select-1.3.0/css/select.bootstrap4.css" />

    <script type="text/javascript" src="jQuery-3.3.1/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="Bootstrap-4-4.1.1/js/bootstrap.js"></script>
    <script type="text/javascript" src="JSZip-2.5.0/jszip.js"></script>
    <script type="text/javascript" src="pdfmake-0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="DataTables-1.10.18/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="DataTables-1.10.18/js/dataTables.bootstrap4.js"></script>
    <script type="text/javascript" src="AutoFill-2.3.3/js/dataTables.autoFill.js"></script>
    <script type="text/javascript" src="AutoFill-2.3.3/js/autoFill.bootstrap4.js"></script>
    <script type="text/javascript" src="Buttons-1.5.6/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="Buttons-1.5.6/js/buttons.bootstrap4.js"></script>
    <script type="text/javascript" src="Buttons-1.5.6/js/buttons.colVis.js"></script>
    <script type="text/javascript" src="Buttons-1.5.6/js/buttons.flash.js"></script>
    <script type="text/javascript" src="Buttons-1.5.6/js/buttons.html5.js"></script>
    <script type="text/javascript" src="Buttons-1.5.6/js/buttons.print.js"></script>
    <script type="text/javascript" src="ColReorder-1.5.0/js/dataTables.colReorder.js"></script>
    <script type="text/javascript" src="FixedColumns-3.2.5/js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript" src="FixedHeader-3.1.4/js/dataTables.fixedHeader.js"></script>
    <script type="text/javascript" src="KeyTable-2.5.0/js/dataTables.keyTable.js"></script>
    <script type="text/javascript" src="Responsive-2.2.2/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="RowGroup-1.1.0/js/dataTables.rowGroup.js"></script>
    <script type="text/javascript" src="RowReorder-1.2.4/js/dataTables.rowReorder.js"></script>
    <script type="text/javascript" src="Scroller-2.0.0/js/dataTables.scroller.js"></script>
    <script type="text/javascript" src="Select-1.3.0/js/dataTables.select.js"></script>

    <script src="angular-1.4.8/angular.min.js"></script>
    <script src="angular-1.4.8/angular.js"></script>


    <!-- <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>-->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head> <img class="kice_logo" src="img/kicelogo.png">
<a class="text_toptic">ระบบยืมอุปกรณ์ออนไลน์</a>

<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
    <div id="cartnum">
        <?php
        $sql = "SELECT * FROM borrowcart WHERE member_id = '$_SESSION[member_id]'";
        $query = $conn->query($sql);
        $num_rows = mysqli_num_rows($query);





        if (isset($_SESSION['mem_type_id']) && @$_SESSION["mem_type_id"] == $_SESSION["mem_type_id"]) { ?>


<div class="button_cont" align="center">
    <a class="btn_cart" onclick="window.location.href='cart.php'">รายการที่เลือก</a>
</div>

          

        <?php } ?>
    </div>


    <!-- Authentication Links -->
    <div >

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- ท่าloginแล้วจะส่งชื่อเข้ามา SESSION  เอามาแสดงผลปุ่มล็อกเอ้าจะแสดง ท่าไม่มีชื่อส่งมาจะแสดงปุ่มเข้าสู่ระบบ และสมัค-->
        <?php
        if (@$_SESSION['mem_type_id'] == 'USER') {
            ?>
            <li class="name_user">
                <?php echo $_SESSION["mem_name"].' /  สถานะ : '.$_SESSION["mem_type_id"]  ?>
               
            </li>
            <li class="name_user">
                <a  href="#" id="logout"> ออกจากระบบ</a>
            </li>
        <?php
        } else if (@$_SESSION['mem_type_id'] == 'MANAGER') {
            ?>
            <li class="name_user">
                <?php echo $_SESSION["mem_name"].' /  สถานะ : '.$_SESSION["mem_type_id"]  ?>
                <a  href="#" id="logout"> ออกจากระบบ</a>
            </li>
        <?php

        } else if (@$_SESSION["mem_type_id"] == 'ADMIN') {
            ?>
            <li class="name_user">
                <?php echo $_SESSION["mem_name"].' /  สถานะ : '.$_SESSION["mem_type_id"]  ?>
                <a  href="#" id="logout"> ออกจากระบบ</a>
            </li>
         
         


    </div>
<?php
} else {   ?> <?php } ?>
</div>
</ul>