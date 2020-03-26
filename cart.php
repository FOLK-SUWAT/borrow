<?php
@include("conf.php");
?>
<?php
session_start();

date_default_timezone_set('Asia/Bangkok');
$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty'])) {
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem) {
        @$meQty = $meQty + $meItem;
    }
} else {
    $meQty = 0;
}

?>

<!DOCTYPE html>
<html lang="th" ng-app="app">



<body ng-app="app" ng-controller="itemdata" ng-init="fetch()">
    <!-- Navbar -->

    <nav class="navbar navbar-expand navbar-expand-sm nav_body ">
        <?php @include('navbar.php') ?>
    </nav>
    <!-- sidebar -->


    <nav class="navbar  navbar-expand-sm nav_menu ">
        <?php @include('sidebar.php') ?>
    </nav>

    <!--check content -->


    <?php if (isset($_SESSION['mem_type_id'])) { ?>

        <!-- content -->





        <body ng-app="app" ng-controller="itemdata" ng-init="fetch()">
            <div class="container">
                <div class="row">

               

                    <div class="col-md-12 col-md-offset-2" style="padding-top: 25px">
                        <div class="alert alert-success text-center" ng-show="success">
                            <button type="button" class="close" ng-click="clearMessage()"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check"></i> {{ successMessage }}
                        </div>
                        <div class="alert alert-danger text-center" ng-show="error">
                            <button type="button" class="close" ng-lick="clearMessage()"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-warning"></i> {{ errorMessage }}
                        </div>




                    </div>
                </div>
                <table class="table table-bordered table-striped" style="margin-top:10px;">
                    <thead>
                        <tr>

                        <th ng-click="sort('item_name')" class="text-center">ชื่ออุปกรณ์
                                <span class="pull-right">
                                    <i class="fa fa-sort gray" ng-show="sortKey!='item_name'"></i>
                                    <i class="fa fa-sort" ng-show="sortKey=='item_name'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                </span>
                            </th>
                            <th ng-click="sort('num_request')" class="text-center">จำนวณที่ต้องการ
                                <span class="pull-right">
                                    <i class="fa fa-sort gray" ng-show="sortKey!='num_request'"></i>
                                    <i class="fa fa-sort" ng-show="sortKey=='num_request'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                </span>
                            </th>


                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr dir-paginate="item in item|orderBy:sortKey:reverse|filter:search|itemsPerPage:10">

                            <td>{{ item.item_name }}</td>
                            <td>{{ item.num_request }}</td>
                          

                            <td>
                                <button type="button" class="btn btn-success" ng-click="showEdit();   selectitem(item);"><i class="fa fa-edit"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger" ng-click="showDelete(); selectitem(item);"> <i class="fa fa-trash"></i> ลบ</button>

                            </td>


                        </tr>
                    </tbody>


                </table>
                <button ng-show="saveModal" type="button" class="btn btn-danger" ng-click="showDeleteall(); selectitem(item);"><i class="fa fa-trash"></i> ลบรายการทั่งหมด</button>
                <button ng-show="saveModal" type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalForm" > บันทึก </button>


                <div class="pull-right" style="margin-top:-30px;">
                    <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true">
                    </dir-pagination-controls>
                </div>
            </div>
            </div>
            <?php include('modalcart.php'); ?>

            </div>
            <script src="dirPaginate.js"></script>
            <script src="borrocart.js"></script>

        </body>






        <!--check content  login -->
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






</body>
<?php @include('filescript.php') ?>


</html>