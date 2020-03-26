<!-- Add Modal -->
<div class="myModal" ng-show="AddModal">
	<div class="modalContainer">
		<div class="modalHeader">
			<span class="headerTitle">Add New category</span>
			<button class="closeBtn pull-right" ng-click="AddModal = false">&times;</button>
		</div>
		<div class="modalBody">

			<div class="form-group">
				<label>รหัสประเภท:</label>
				<input type="text" class="form-control" ng-model="type_id" id="type_id" name="type_id">
				<span class="pull-right input-error" ng-show="errortype_id">{{ errorMessage }}</span>
			</div>
			<div class="form-group">
				<label>ชื่อประเภท:</label>
				<input type="text" class="form-control" ng-model="type_name" id="type_name" name="type_name">
				<span class="pull-right input-error" ng-show="errortype_name">{{ errorMessage }}</span>
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
				<label>รหัสประเภท:</label>
				<input type="text" class="form-control" ng-model="clickcat_type.type_id">
			</div>
			<div class="form-group">
				<label>ชื่อประเภท:</label>
				<input type="text" class="form-control" ng-model="clickcat_type.type_name">
			</div>


		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="EditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button class="btn btn-success" ng-click="EditModal = false; updatecat_type();"><span class="glyphicon glyphicon-check"></span> Save</button>
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
			<h2 class="text-center">ลบประเภท :{{ clickcat_type.type_name }} </h2>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="DeleteModal = false"><span class="glyphicon glyphicon-remove">
					</span> Cancel</button>
				<button class="btn btn-danger" ng-click="DeleteModal = false; deletecat_type(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>