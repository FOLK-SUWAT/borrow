<?php
@include("conf.php");
?>
<?php
session_start();

date_default_timezone_set('Asia/Bangkok');


$cat_data = '';
$query = "SELECT * FROM mem_type GROUP BY mem_type_department ORDER BY mem_type_department ASC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    @$mem_id .= '<option value="' . $row["mem_id"] . '">' . $row["mem_type_department"] . '</option>';
}
?>

<!DOCTYPE html>
<html lang="th" ng-app="app">



<body ng-controller="itemdata" ng-init="fetch()">
    <!-- Navbar -->

    <nav class="navbar navbar-expand navbar-expand-sm nav_body ">
        <?php @include('navbar.php') ?>
    </nav>
    <!-- sidebar -->


    <nav class="navbar  navbar-expand-sm menu_body   ">
        <?php @include('sidebar.php') ;
        ?>
    </nav>

    <!--check content -->


    <?php if (isset($_SESSION['mem_type_id'])) { ?>

        <!-- content -->








        <body id="testdiv" ng-controller="itemdata" ng-init="fetch()">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 col-md-offset-2" style="padding-top: 25px">
                        <div class="alert alert-success text-center" ng-show="success">
                            <button type="button" class="close" ng-click="clearMessage()"><span aria-hidden="true">&times;</span></button>
                           {{ successMessage }}
                        </div>
                        
                        <div class="alert alert-danger text-center" ng-show="error">
                            <button type="button" class="close" ng-lick="clearMessage()"><span aria-hidden="true">&times;</span></button>
                            {{ errorMessage }}
                        </div>
                        <div class="row row_topic">
                        <div class="col-md-4">
                            <h1 class ="index_topic">รายการอุปกรณ์</h1>
                        </div>
                        <div class="col-md-3 row_search">
                            <span id="search" class="pull-left" >
                                    <input type="text" ng-model="search" class="form-control textbox_search_1" placeholder="ค้นหาอุปกรณ์">
                            </span>
                        </div>
                        <div class="col-md-4 row_search">
                                <form method="post" ng-model="data" ng-submit="submitForm()" >
                                    <input class="btn-Send  form-group pull-right" type="submit" name="submit" value="ค้นหา" />
                                    <select class="form-control textbox_search_borrow" name="content" id="content" ng-model="data.content" >
                                        <option value=''>เลือก แผนก</option>
                                        <option value='mem_type.mem_id'>ทุกแผนก</option>
                                        <?php echo $mem_id; ?>
                                    </select>
                                </form>
                        </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th ng-click="sort('cat_name')" class="text-center">รูป
                                <th ng-click="sort('item_name')" class="text-center">อุปกรณ์แผนก
                                    <span class="pull-right">
                                        <i class="fa fa-sort gray" ng-show="sortKey!='item_name'"></i>
                                        <i class="fa fa-sort" ng-show="sortKey=='item_name'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                    </span>
                                </th>
                                <th ng-click="sort('item_name')" class="text-center">ชื่ออุปกรณ์
                                    <span class="pull-right">
                                        <i class="fa fa-sort gray" ng-show="sortKey!='item_name'"></i>
                                        <i class="fa fa-sort" ng-show="sortKey=='item_name'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                    </span>
                                </th>
                                <th ng-click="sort('detail')" class="text-center">รายละเอียดอุปกรณ์
                                    <span class="pull-right">
                                        <i class="fa fa-sort gray" ng-show="sortKey!='detail'"></i>
                                        <i class="fa fa-sort" ng-show="sortKey=='detail'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                    </span>
                                </th>
                                <th ng-click="sort('serail')" class="text-center">หมายเลขอุปกรณ์
                                    <span class="pull-right">
                                        <i class="fa fa-sort gray" ng-show="sortKey!='serail'"></i>
                                        <i class="fa fa-sort" ng-show="sortKey=='serail'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                    </span>
                                </th>
                                <th ng-click="sort('in_use')" class="text-center">จำนวนคงเหลือ
                                    <span class="pull-right">
                                        <i class="fa fa-sort gray" ng-show="sortKey!='in_use'"></i>
                                        <i class="fa fa-sort" ng-show="sortKey=='in_use'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                    </span>
                                </th>
                                <th ng-click="sort('in_use')" class="text-center">จอง
                                    <span class="pull-right">
                                        <i class="fa fa-sort gray" ng-show="sortKey!='in_use'"></i>
                                        <i class="fa fa-sort" ng-show="sortKey=='in_use'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                    </span>
                                </th>

                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr dir-paginate="item in item|orderBy:sortKey:reverse|filter:search:[]|itemsPerPage:10">
                                

                                <td><img ng-src="{{  item.picture }}" style="width: 128px;height: auto;" /></a></td>
                                <td>{{ item.mem_type_department }}</td>
                                <td>{{ item.item_name }}</td>
                                <td>{{ item.detail }}</td>
                                <td>{{ item.serail }}</td>
                                <td class="text-primary">{{ item.in_use }}</td>
                                <td class="text-warning" >{{ item.Reservations }}</td>
                                

                                <td>
                                    <button type="button" id="" class="btn btn-success" ng-click="showEdit();selectitem(item); "><i class="fa fa-edit"></i> เลือก</button>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                        
                </div>
                        <div class="pull-right" style="margin-top:-10px;">
                            <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true">
                            </dir-pagination-controls>
                        </div>
            </div>
            <?php include('modalborrow.php'); ?>

            </div>
            <script src="dirPaginate.js"></script>
            <script src="borrowitem.js"></script>

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

