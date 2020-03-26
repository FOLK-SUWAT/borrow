<?php
include('conf.php');


@session_start();
$department =   $_SESSION["department"];



$type_id = '';
$query = "SELECT * FROM category_type WHERE mem_type_department = '$department'";
@$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($result)) {
	@$type_id .= '<option value="'. $row["id"] .'">' . $row["type_name"] . '</option>';
}

?>
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance:textfield;
}
</style>

<!-- Add Modal -->
<div ng-show="AddModal" class="myModal">
	<div class="modalContainer" style="width:800px">
		<div class="modalHeader">
			<span class="headerTitle">Add New item</span>
			<button class="closeBtn pull-right" ng-click="AddModal = false">&times; Close</button>
		</div>
		<form id="ins_rec" enctype="multipart/form-data">
		<div class="modalBody">
			<div class="row">
		
				<div class="col-md-6">
					<div class="form-group">
						<label>ประเภท:</label>
						<select ng-model='type_id' name="type_id" id="type_id" class="form-control action">
							<option value="">เลือก ประเภท</option>
							<?php echo $type_id; ?>
						</select>
						<span class="pull-right input-error" ng-show="errortype_id">{{ errorMessage }}</span>

						<label>หมวดหมู่:</label>

						<select ng-model='cat_id' name="cat_id" id="cat_id" class="form-control action">
							<option value="">เลือก หมวดหมู่</option>
							<?php echo $cat_id; ?>
						</select>
						<span class="pull-right input-error" ng-show="errorcat_name">{{ errorMessage }}</span>
					</div>

					<div class="form-group">
						<label> หมายเลขอุปกรณ์:</label>
						<input type="text" class="form-control" ng-model="	serail" id="serail" name="serail">
						<span class="pull-right input-error" ng-show="error	serail">{{ errorMessage }}</span>
					</div>
					<div class="form-group">
						<label>ชื่ออุปกรณ์:</label>
						<input type="text" class="form-control" ng-model="item_name" id="item_name" name="item_name">
						<span class="pull-right input-error" ng-show="erroritem_name">{{ errorMessage }}</span>
					</div>
					<div class="form-group">
						<label>รายละเอียดอุปกรณ์:</label>
						<input type="text" class="form-control" ng-model="detail" id="detail" name="detail">
						<span class="pull-right input-error" ng-show="errordetail">{{ errorMessage }}</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>จำนวน:</label>
						<input type="number" class="form-control" ng-model="in_use" id="in_use" name="in_use">
						<span class="pull-right input-error" ng-show="errorin_use">{{ errorMessage }}</span>
					</div>

					<div class="form-group">
						<label>รูปภาพอุปกรณ์:</label>
						<input id="uploadImage" type="file" accept="image/*" name="image" ng-model="image" />
						
					</div>

				</div>
				
			</div>
		</div>
		
	
				<div class="modalFooter">
					<div class="footerBtn pull-right">
						<button class="btn btn-default" type="submit" value="Post"><span class="glyphicon glyphicon-remove"></span> Save</button>
					</div>
				</div>
		</form>
	</div>
</div>

<!-- Edit Modal -->
<div class="myModal" ng-show="EditModal">

	<div class="modalContainer">
		<div class="editHeader">
			<span class="headerTitle">Edit item</span>
			<button class="closeEditBtn pull-right" ng-click="EditModal = false">&times;</button>
		</div>
		<div class="modalBody">

			<div class="form-group" hidden>
				<label>create_date:</label>
				<input type="text" class="form-control" ng-model="clickitem.create_date">
			</div>
			<div class="form-group">
				<label>ประเภท:</label>

				<select ng-model='clickitem.type_id' name="type_idedit" id="type_idedit" class="form-control action">
					<option value="">เลือก ประเภท</option>
					<?php echo $type_id; ?>
				</select>
			</div>
			<div id='display' style='display:none'>
				<div class="form-group">
					<label>เปลียน หมวดหมู่:</label>
					<select ng-model='clickitem.cat_idedit' name="cat_idedit" id="cat_idedit" class="form-control action">
						<option value="">เลือก หมวดหมู่</option>
						<?php echo $cat_idedit; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>ชื่ออุปกรณ์:</label>
				<input type="text" class="form-control" ng-model="clickitem.item_name">
			</div>
			<div class="form-group">
				<label>รายละเอียดอุปกรณ์:</label>
				<input type="text" class="form-control" ng-model="clickitem.detail">
			</div>
			<div class="form-group">
				<label>หมายเลขอุปกรณ์:</label>
				<input type="text" class="form-control" ng-model="clickitem.serail">
			</div>
			<div class="form-group">
				<label>จำนวน:</label>
				<input type="text" class="form-control" ng-model="clickitem.in_use">
			</div>
			<form id="editupload" enctype="multipart/form-data">
				<div class="form-group">
							<label>รูปภาพอุปกรณ์:</label>
							<input type="text" ng-model="clickitem.item_id" value='clickitem.item_id' id='item_id' name='item_id' hidden/>  
							<input type="file" file-input="files" />  
							<button class="btn btn-info" value='clickitem.item_id' ng-click="uploadFile()">Upload</button>  
				</div>
			</form>
			<img id="pictureold" ng-src="{{  clickitem.picture }}" style="width: 128px;height: auto;" /></a>
			<p class="statusMsg"></p>

		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="EditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button class="btn btn-success" ng-click="EditModal = false; updateitem();"><span class="glyphicon glyphicon-check"></span> Save</button>
			</div>
		</div>
	</div>
</div>




<!-- Delete Modal -->
<div class="myModal" ng-show="DeleteModal">
	<div class="modalContainer">
		<div class="deleteHeader">
			<span class="headerTitle">Delete item</span>
			<button class="closeDelBtn pull-right" ng-click="DeleteModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">ลบหมายเลขอุปกรณ์</h5>
			<h2 class="text-center"> {{clickitem.serail}} </h2>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="DeleteModal = false"><span class="glyphicon glyphicon-remove">
					</span> Cancel</button>
				<button class="btn btn-danger" ng-click="DeleteModal = false; deleteitem(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>


<?php @include('filescript.php') ?>

<script type="text/javascript">
	$('#ins_rec').on("submit", function(e) {
		e.preventDefault();
		var numbers = /^[A-Z]+$/;
		var type_id = $('#type_id').val();
    	var cat_id = $('#cat_id').val();
		var serail = $('#serail').val();
		var item_name = $('#item_name').val();
		var detail = $('#detail').val();
		var in_use = $('#in_use').val();
		var unit_name = $('#unit_name').val();
		
		if(type_id.trim() == '' ){
			alert('กรุณาใส่ ประเภท');
			$('#type_id').focus();
			return false;
		}else if(cat_id.trim() == '' ){
			alert('กรุณาใส่ หมวดหมู่');
			$('#cat_id').focus();
			return false;
   		 }else if(serail.trim() == '' ){
			alert('กรุณาใส่ หมายเลขอุปกรณ์');
			$('#serail').focus();
			return false;
   		 }else if(item_name.trim() == '' ){
			alert('กรุณาใส่ ชื่ออุปกรณ์');
			$('#item_name').focus();
			return false;
   		 }else if(detail.trim() == '' ){
			alert('กรุณาใส่ รายละเอียดอุปกรณ์');
			$('#detail').focus();
			return false;
   		 }else if(in_use.trim() == '' ){
			alert('กรุณาใส่ จำนวน');
			$('#in_use').focus();
			return false;
   		 
   		 }else{
				$.ajax({
					type: 'POST',
					url: 'additem.php',
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function(msg) {
						$('#ins_rec').trigger('reset');
						$('#close_click').trigger('click');
						alert(msg)
							var timer = setInterval(function () {
								window.location.reload(); 		
						}, 500);

						location.reload();
					}
				});
		}

	});


	$(document).ready(function() {
		$('.action').change(function() {
			if ($(this).val() != '') {
				var action = $(this).attr("id");
				var query = $(this).val();
				var result = '';
				if (action == "type_id") {
					result = 'cat_id';
				}
				$.ajax({
					url: "fetchtype.php",
					method: "POST",
					data: {
						action: action,
						query: query
					},
					success: function(data) {
						$('#' + result).html(data);
					}
				})
			}
		});



		$('.action').change(function() {

			if ($(this).val() != '') {
				var action = $(this).attr("id");
				var query = $(this).val();
				var ds = document.getElementById('display');
				var result = '';
				if (action == "type_idedit") {
					result = 'cat_idedit';
					ds.style.display = 'block';
				}
				$.ajax({
					url: "fetchtypeedit.php",
					method: "POST",
					data: {
						action: action,
						query: query
					},
					success: function(data) {
						$('#' + result).html(data);
					}
				})
			}
		});

	});
</script>