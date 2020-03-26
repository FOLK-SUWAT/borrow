<?php
include('conf.php');
$cat_data = '';
$query = "SELECT * FROM mem_type ";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
	@$department .= '<option value="' . $row["mem_id"] .'">' . $row["mem_type_department"] . '</option>';
}
?>
<!-- Add Modal -->
<div class="myModal" ng-show="AddModal">
	<div class="modalContainer">
		<div class="modalHeader">
			<span class="headerTitle">Add New Member</span>
			<button class="closeBtn pull-right" ng-click="AddModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<div class="form-group">
				<label>ชื่อสมาชิก:</label>
				<input type="text" class="form-control" ng-model="mem_name" id="mem_name">
				<span class="pull-right input-error" ng-show="errormem_name">{{ errorMessage }}</span>
			</div>
			<div class="form-group">
				<label>อีเมล:</label>
				<input type="text" class="form-control" ng-model="email" id="email" name="email">
				<span class="pull-right input-error" ng-show="erroremail">{{ errorMessage }}</span>
				<span class="error-msg" id="msg_2"></span>
				<span id="email_response" style="color:red;" style=""></span>
			</div>
			<div class="form-group">
				<label>แผนก:</label>
				<select ng-model='department' name="department" id="department" class="form-control action">
					<option value="">เลือก แผนก</option>
					<?php echo $department; ?>
				</select>
				<span class="pull-right input-error" ng-show="errordepartment">{{ errorMessage }}</span>
			</div>
			<div class="form-group">
				<label>รหัสผ่าน:</label>
				<input type="password" class="form-control" ng-model="password" id="password">
				<span class="pull-right input-error" ng-show="errorpassword">{{ errorMessage }}</span>
			</div>
			<div class="form-group">
				<label>ประเภทสมาชิก:</label>
				<select class="custom-select" name="mem_type_id" id="mem_type_id" ng-model="mem_type_id">
					<option value="" selected>เลือกประเภทสมาชิก</option>
					<option value="USER">USER</option>
					<option value="MANAGER">MANAGER</option>
					<option value="ADMIN">ADMIN</option>
				</select>

				<span class="pull-right input-error" ng-show="errormem_type_id">{{ errorMessage }}</span>
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
			<span class="headerTitle">Edit Member</span>
			<button class="closeEditBtn pull-right" ng-click="EditModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<div class="form-group">
				<label>ชื่อสมาชิก:</label>
				<input type="text" class="form-control" ng-model="clickMember.mem_name">
			</div>
			<div class="form-group">
				<label>อีเมล:</label>
				<input type="text" class="form-control" ng-model="clickMember.email">
			</div>

			<div class="form-group">
				<label>แผนก:</label>
				<select ng-model="clickMember.department" class=" form-control action">
					<option value="">เลือก แผนก</option>
					<?php echo $department; ?>
				</select>
				<span class="pull-right input-error" ng-show="errordepartment">{{ errorMessage }}</span>
			</div>
			<div class="form-group">
				<label>รหัสผ่าน:</label>
				<input type="password" class="form-control" ng-model="clickMember.password">
			</div>
			<div class="form-group">
				<label>ประเภทสมาชิก:</label>
				<select class="custom-select" class="form-control" ng-model="clickMember.mem_type_id">
					<option value="" selected>เลือกข้อมูล</option>
					<option value="USER">USER</option>
					<option value="MANAGER">MANAGER</option>
					<option value="ADMIN">ADMIN</option>
				</select>
			</div>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="EditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-success" ng-click="EditModal = false; updateMember();"><span class="glyphicon glyphicon-check"></span> Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div class="myModal" ng-show="DeleteModal">
	<div class="modalContainer">
		<div class="deleteHeader">
			<span class="headerTitle">Delete Member</span>
			<button class="closeDelBtn pull-right" ng-click="DeleteModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">ลบ Email</h5>
			<h2 class="text-center">{{clickMember.email}}</h2>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="DeleteModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-danger" ng-click="DeleteModal = false; deleteMember(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>

<?php @include('filescript.php') ?>