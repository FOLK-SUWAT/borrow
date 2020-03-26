<?php
@include("conf.php");
?>
<?php
session_start();
date_default_timezone_set('Asia/Bangkok');


?>

<!DOCTYPE html>
<html lang="th" ng-app="app">


<body ng-controller="itemdata" ng-init="fetch()">
	<!-- Navbar -->

	<nav class="navbar navbar-expand navbar-expand-sm nav_body ">
		<?php @include('navbar.php') ?>
	</nav>
	<!-- sidebar -->


	<nav class="navbar  navbar-expand-sm menu_body ">
		<?php @include('sidebar.php') ?>
	</nav>

	<!--check content -->


	<?php if (isset($_SESSION['mem_type_id'])  or ($_SESSION['mem_type_id'] == "ADMIN") or ($_SESSION['mem_type_id'] == "MANAGER")) { ?>

		<!-- content -->





		<body ng-controller="itemdata" ng-init="fetch()">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-md-offset-2" style="padding-top: 25px">
						<div class="alert alert-success text-center" ng-show="success" id="success">
							<button type="button" class="close" ng-click="clearMessage()"><span aria-hidden="true">&times;</span></button>
							<i class="fa fa-check"></i> {{ successMessage }}
						</div>
						<div class="alert alert-danger text-center" ng-show="error">
							<button type="button" class="close" ng-lick="clearMessage()"><span aria-hidden="true">&times;</span></button>
							<i class="fa fa-warning"></i> {{ errorMessage }}
						</div>

						<div class="row row_topic">
							<div class="col-md-4">
								<h1 class="index_topic">รายการอุปกรณ์</h1>
							</div>
							<div class="col-md-3 row_search">
								<input type="text" ng-model="search" class="form-control" placeholder="Search">
							</div>
							<div class="col-md-5 row_btn">
								<button href="" class="btn btn-Send" ng-click="showAdd()"><i class="fa fa-plus"></i> เพิ่ม อุปกรณ์</button>
							</div>



						</div>
					</div>
					<table class="table table-bordered table-striped" style="margin-top:10px;">
						<thead>
							<tr>
								<th ng-click="sort('cat_name')" class="text-center">หมวดหมู่
									<span class="pull-right">
										<i class="fa fa-sort gray" ng-show="sortKey!='cat_name'"></i>
										<i class="fa fa-sort" ng-show="sortKey=='cat_name'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
									</span>
								</th>
								<th ng-click="sort('type_name')" class="text-center">ประเภท
									<span class="pull-right">
										<i class="fa fa-sort gray" ng-show="sortKey!='type_name'"></i>
										<i class="fa fa-sort" ng-show="sortKey=='type_name'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
									</span>
								</th>
								<th ng-click="sort('serail')" class="text-center">หมายเลขอุปกรณ์
									<span class="pull-right">
										<i class="fa fa-sort gray" ng-show="sortKey!='serail'"></i>
										<i class="fa fa-sort" ng-show="sortKey=='serail'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
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

								<th ng-click="sort('in_use')" class="text-center">จำนวน
									<span class="pull-right">
										<i class="fa fa-sort gray" ng-show="sortKey!='in_use'"></i>
										<i class="fa fa-sort" ng-show="sortKey=='in_use'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
									</span>
								</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr dir-paginate="item in item|orderBy:sortKey:reverse|filter:search|itemsPerPage:10">
								<td>{{ item.cat_name }}</td>
								<td>{{ item.type_name }}</td>
								<td>{{ item.serail }}</td>
								<td>{{ item.item_name }}</td>
								<td>{{ item.detail }}</td>
								<td>{{ item.in_use }}</td>

								<td>
									<button type="button" class="btn btn-success" ng-click="showEdit(); selectitem(item);"><i class="fa fa-edit"></i> Edit</button>
									<button type="button" class="btn btn-danger" ng-click="showDelete(); selectitem(item);"> <i class="fa fa-trash"></i> Delete</button>
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
			<?php include('modalmanager.php'); ?>
			</div>
			<script src="dirPaginate.js"></script>
			<script src="item.js"></script>

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