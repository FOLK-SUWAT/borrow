<?php
@include("conf.php");
?>
<?php
session_start();
date_default_timezone_set('Asia/Bangkok');


?>

<!DOCTYPE html>
<html lang="th" ng-app="app">




<body ng-controller="memberdata" ng-init="fetch()">
    <!-- Navbar -->

    <nav class="navbar navbar-expand navbar-expand-sm nav_body ">
        <?php @include('navbar.php') ?>
    </nav>
    <!-- sidebar -->


    <nav class="navbar  navbar-expand-sm menu_body  ">
        <?php @include('sidebar.php') ?>
    </nav>

    <?php if (isset($_SESSION['mem_type_id']) && @$_SESSION["mem_type_id"] == "ADMIN") { ?>

        <!-- content -->





        <body ng-controller="memberdata" ng-init="fetch()">
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


                        <div class="row row_topic">
                            <div class="col-md-4">
                                <h1 class="index_topic">ข้อมูลแผนก</h1>
                            </div>
                            <div class="col-md-3 row_search">
                                <input type="text" ng-model="search" class="form-control" placeholder="Search">
                            </div>
                            <div class="col-md-5 row_btn">
                                <button href="" class="btn btn-Send" ng-click="showAdd()"><i class="fa fa-plus"></i> เพิ่ม แผนก</button>
                               
                            </div>
                        </div>
                        <table class="table table-bordered table-striped" style="margin-top:10px;">
                            <thead>
                                <tr>
                                    <th ng-click="sort('mem_type_id')" class="text-center">รหัส
                                        <span class="pull-right">
                                            <i class="fa fa-sort gray" ng-show="sortKey!='mem_type_id'"></i>
                                            <i class="fa fa-sort" ng-show="sortKey=='mem_type_id'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                        </span>
                                    </th>
                                    <th ng-click="sort('mem_type_department')" class="text-center">แผนก
                                        <span class="pull-right">
                                            <i class="fa fa-sort gray" ng-show="sortKey!='mem_type_department'"></i>
                                            <i class="fa fa-sort" ng-show="sortKey=='mem_type_department'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                        </span>
                                    </th>
                                    <th ng-click="sort('line_token')" class="text-center">Line Token
                                        <span class="pull-right">
                                            <i class="fa fa-sort gray" ng-show="sortKey!='line_token'"></i>
                                            <i class="fa fa-sort" ng-show="sortKey=='line_token'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                        </span>
                                    </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr dir-paginate="member in member|orderBy:sortKey:reverse|filter:search|itemsPerPage:10">
                                    <td>{{ member.mem_id }}</td>
                                    <td>{{ member.mem_type_department }}</td>
                                    <td>{{ member.line_token }}</td>



                                    <td>
                                        <button type="button" class="btn btn-success" ng-click="showEdit(); selectMember(member);"><i class="fa fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-danger" ng-click="showDelete(); selectMember(member);"> <i class="fa fa-trash"></i> Delete</button>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="pull-right" style="margin-top:-30px;">
                            <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true">
                            </dir-pagination-controls>
                        </div>
                    </div>
                </div>
                <?php include('modaldepartment.php'); ?>
            </div>
            <script src="dirPaginate.js"></script>
            <script src="department.js"></script>
        </body>



        <div id="loginModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">&nbsp;Login</h2>
                    </div>
                    <div class="modal-body">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" />
                        <br />
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" />
                        <br />
                        <button type="button" name="login_button" id="login_button" class="button button-login">Login</button>
                    </div>
                </div>
            </div>
        </div>


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