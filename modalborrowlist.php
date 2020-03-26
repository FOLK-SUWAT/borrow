<?php
include('conf.php');

?>


<!-- Edit Modal -->
<div class="myModal" ng-show="EditModal">

	<div class="modalContainer">
		<div class="editHeader" hidden>
			<span class="headerTitle">Edit item</span>
			<button class="closeEditBtn pull-right" ng-click="EditModal = false">&times;</button>
		</div>
		<div class="modalBody">


			<div class="form-group">
				<label>เลขรายการยืม:</label>
				<input type="text" class="form-control" ng-model="clickborrow.borrow_bill" id="borrow_bill" name="borrow_bill" disabled>
			</div>
			<div class="form-group">
				<label>หัวข้อการยืม:</label>
				<input type="text" class="form-control" ng-model="clickborrow.borrow_topic" id="borrow_topic" name="borrow_topic">
			</div>


			<div class="form-group">
				<p>วันที่ต้องการยืม:
					<input type="text" class="form-control" ng-model="clickborrow.borrow_date" id="borrow_date" name="borrow_date">
				</p>
			</div>

			<div class="form-group">
				<p>วันที่คืน:
					<input type="text" class="form-control" ng-model="clickborrow.return_date" id="return_date" name="return_date">

				</p>
			</div>

		</div>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="EditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button class="btn btn-success" ng-click="EditModal = false; updateborrow();"><span class="glyphicon glyphicon-check"></span> Save</button>
			</div>
		</div>
	</div>
</div>


<!-- Edititem Modal -->
<div class="myModal" ng-show="EdititemModal">

	<div class="modalContainer">
		<div class="editHeader" hidden>
			<span class="headerTitle">Edit item</span>
			<button class="closeEditBtn pull-right" ng-click="EditModal = false">&times;</button>
		</div>
		<div class="modalBody">


			<div class="form-group">
				<label>เลขรายการยืม:</label>
				<input type="text" class="form-control" ng-model="clickborrow.item_order" id="item_order" name="item_order" disabled>
			</div>
			<div class="form-group">
				<label>ชื่ออุปกรณ์:</label>
				<input type="text" class="form-control" ng-model="clickborrow.item_name" id="item_name" name="item_name" disabled>
			</div>


			<div class="form-group">
				<p>จำนวนที่ต้องการยืม:
					<input type="text" class="form-control" ng-model="clickborrow.num_request" id="num_request" name="num_request">
				</p>
			</div>


		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="EdititemModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button class="btn btn-success" ng-click="EdititemModal = false; updateitem();"><span class="glyphicon glyphicon-check"></span> Save</button>
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
			<h5 class="text-center">ลบหัวข้องาน</h5>
			<h2 class="text-center">{{ clickborrow.borrow_topic }} </h2>
			<h2 class="text-center">หมายเลขใบยืม : {{ clickborrow.borrow_bill }} </h2>
			
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="DeleteModal = false"><span class="glyphicon glyphicon-remove">
					</span> Cancel</button>
				<button class="btn btn-danger" ng-click="DeleteModal = false; deleteborrow(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>



<!-- Deleteborrow Modal -->
<div class="myModal" ng-show="DeleteitemModal">
	<div class="modalContainer">
		<div class="deleteHeader">
			<span class="headerTitle">Delete cat</span>
			<button class="closeDelBtn pull-right" ng-click="DeleteModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">ลบอุปกรณ์</h5>
			<h2 class="text-center">{{ clickborrow.item_name }} </h2>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="DeleteitemModal = false"><span class="glyphicon glyphicon-remove">
					</span> Cancel</button>
				<button class="btn btn-danger" ng-click="DeleteitemModal = false; deleteborrowitem(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>

<?php @include('filescript.php') ?>

<script type="text/javascript">
	$('#ins_rec').on("submit", function(e) {
		e.preventDefault();
		$.ajax({

			type: 'POST',
			url: 'additem.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function() {


				$('#ins_rec').trigger('reset');
				$('#close_click').trigger('click');

				location.reload();
			}

		});

	});

	$(document).ready(function() {
		$('.action').change(function() {
			if ($(this).val() != '') {
				var action = $(this).attr("id");
				var query = $(this).val();
				var result = '';
				if (action == "cat_id") {
					result = 'type_id';
				} else if (action == "type_id") {
					result = 'model_id';
				} else if (action == "model_id") {
					result = "unit_id";
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
				if (action == "cat_idedit") {
					result = 'type_idedit';
					ds.style.display = 'block';
				} else if (action == "type_idedit") {
					result = 'model_idedit';
				} else if (action == "model_idedit") {
					result = "unit_idedit";
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