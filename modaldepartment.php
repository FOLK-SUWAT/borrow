<!-- Add Modal -->
<div class="myModal" ng-show="AddModal">
	<div class="modalContainer">
		<div class="modalHeader">
			<span class="headerTitle">Add New department</span>
			<button class="closeBtn pull-right" ng-click="AddModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<div class="form-group">
				<label>ชื่อแผนก:</label>
				<input type="text" class="form-control" ng-model="department" id="department">
				<span class="pull-right input-error" ng-show="errordepartment">{{ errorMessage }}</span>
			</div>
			<div class="form-group">
				<label>Line Token:</label>
				<input type="text" class="form-control" ng-model="line_token" id="line_token">
				<span class="pull-right input-error" ng-show="errorline_token">{{ errorMessage }}</span>
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
				<label>department:</label>
				<input type="text" class="form-control" ng-model="clickMember.mem_type_department">
			</div>

			<div class="form-group">
				<label>Line Token:</label>
				<input type="text" class="form-control" ng-model="clickMember.line_token">
			</div>
		</div>
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
			<h5 class="text-center">ลบ แผนก </h5>
			<h2 class="text-center">รหัส:{{clickMember.mem_id}} </h2><br>
			<h2 class="text-center">แผนก: {{clickMember.mem_type_department}}</h2>
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