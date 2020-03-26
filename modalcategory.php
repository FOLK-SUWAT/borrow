<?php
@include('conf.php');

@session_start();
$department =   $_SESSION["department"];






$type_id = '';
$query = "SELECT * FROM category_type WHERE mem_type_department = '$department'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {
	$type_id .= '<option value="'. $row["id"] .'">' . $row["type_name"] . '</option>';
}


?>
<!-- Add Modal -->
<div class="myModal" ng-show="AddModal">
	<div class="modalContainer">
		<div class="modalHeader">
			<span class="headerTitle">Add New category</span>
			<button class="closeBtn pull-right" ng-click="AddModal = false">&times;</button>
		</div>
		<div class="modalBody">

			<div class="form-group">
			<label>ประเภท:</label>
			<option value="">เลือก ประเภท</option>

						<select ng-model='type_id' name="type_id" id="type_id" class="form-control action">

							<?php echo $type_id; ?>
						</select>
				<span class="pull-right input-error" ng-show="errortype_id">{{ errorMessage }}</span>
			</div>






			<div class="form-group">
				<label>รหัสหมวดหมู่:</label>
				<input type="text" class="form-control" ng-model="cat_id" id="cat_id" name="cat_id">
				<span class="pull-right input-error" ng-show="errorcat_id">{{ errorMessage }}</span>
			</div>
			<div class="form-group">
				<label>หมวดหมู่:</label>
				<input type="text" class="form-control" ng-model="cat_name" id="cat_name" name="cat_name">
				<span class="pull-right input-error" ng-show="errorcat_name">{{ errorMessage }}</span>
			</div>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="AddModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button class="btn btn-primary" ng-click="addnew()"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Modal -->
<div class="myModal" ng-show="EditModal">
	<div class="modalContainer">
		<div class="editHeader">
			<span class="headerTitle">Edit category</span>
			<button class="closeEditBtn pull-right" ng-click="EditModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<div class="form-group">
				<label>รหัสหมวดหมู่:</label>
				<input type="text" class="form-control" ng-model="clickcat.cat_id">
			</div>
			<div class="form-group">
				<label>หมวดหมู่:</label>
				<input type="text" class="form-control" ng-model="clickcat.cat_name">
			</div>


		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="EditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button class="btn btn-success" ng-click="EditModal = false; updatecat();"><span class="glyphicon glyphicon-check"></span> Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div class="myModal" ng-show="DeleteModal">
	<div class="modalContainer">
		<div class="deleteHeader">
			<span class="headerTitle">Delete cat</span>
			<button class="closeDelBtn pull-right" ng-click="DeleteModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">ลบรหัสหมวดหมู่:  {{ clickcat.cat_id }} </h5>
			<h2 class="text-center">ลบหมวดหมู่:  {{ clickcat.cat_name }} </h2>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="DeleteModal = false"><span class="glyphicon glyphicon-remove">
					</span> Cancel</button>
				<button class="btn btn-danger" ng-click="DeleteModal = false; deletecat(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>