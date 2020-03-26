<?php
@include("conf.php");
?>
<?php
session_start();
date_default_timezone_set('Asia/Bangkok');


?>

<!DOCTYPE html>
<html lang="th" ng-app="app">





<body ng-controller="catdata" ng-init="fetch()">
	<!-- Navbar -->

	<nav class="navbar navbar-expand navbar-expand-sm nav_body ">
		<?php @include('navbar.php') ?>
	</nav>
	<!-- sidebar -->


	<nav class="navbar  navbar-expand-sm menu_body  ">
		<?php @include('sidebar.php') ?>
	</nav>

	<!--check content -->


	<?php if (isset($_SESSION['mem_type_id']) && @$_SESSION["mem_type_id"] == $_SESSION["mem_type_id"]) { ?>

		<!-- content -->





		<body ng-controller="catdata" ng-init="fetch()">
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
								<h1 class="index_topic">ประเภทอุปกรณ์</h1>
							</div>
							<div class="col-md-3 row_search_addcat">
								<input type="text" ng-model="search" class="form-control" placeholder="Search">
							</div>
							<div class="col-md-5 row_btn_addcat">
								<button href="" class="btn btn-Send" ng-click="showAdd()"><i class="fa fa-plus"></i> เพิ่ม ประเภทอุปกรณ์</button>
								<a href="manager.php" class="btn btn-Send"></i> กลับหน้าหลัก</a>
							</div>
						</div>
					</div>
					<table class="table table-bordered table-striped" style="margin-top:10px;">
						<thead>
							<tr>
								<th ng-click="sort('cat_name')" class="text-center">รหัสประเภท
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


								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<!-- cat in cat เรียกใช้ฟังชั้นdataจากไฟล์cat.js  //  itemsPerPage = จำนวณคอลั้ม1ต่อหน้า -->
							<tr dir-paginate="cat_type in cat_type|orderBy:sortKey:reverse|filter:search|itemsPerPage:10">
								<td>{{ cat_type.type_id}} </td>
								<td>{{ cat_type.type_name }}</td>


								<td>
									<button type="button" class="btn btn-success" ng-click="showEdit(); selectcat_type(cat_type);"><i class="fa fa-edit"></i> Edit</button>
									<button type="button" class="btn btn-danger" ng-click="showDelete(); selectcat_type(cat_type);"> <i class="fa fa-trash"></i> Delete</button>
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
			<?php include('modalcategory_type.php'); ?>
			</div>
			<script src="dirPaginate.js"></script>
			<script src="cat_type.js"></script>
		</body>






		<!--check content  login -->
	<?php } else { ?>

		<div id="content-wrapper">
			<div class="container-fluid">
				<div>
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title">&nbsp;Login</h2>
							</div>
							<div class="modal-body">
								<label>Email</label>
								<input type="email" name="email" id="email" class="form-control" />
								<br />
								<label>Password</label>
								<input type="password" name="password" id="password" class="form-control" />
								<br />
								<button type="button" name="login_button" id="login_button" class="button button-login">Login</button>
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