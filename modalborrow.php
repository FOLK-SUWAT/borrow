<?php
include('conf.php');


date_default_timezone_set("Asia/Bangkok");
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

<!-- Edit Modal -->
<div class="myModal" ng-show="EditModal">

	<div class="modalContainer">
		<div class="editHeader" hidden>
			<span class="headerTitle">Edit item</span>
			<button class="closeEditBtn pull-right" ng-click="EditModal = false">&times;</button>
		</div>
		<div class="modalBody">

			<div class="form-group" hidden>
				<label>create_date:</label>
				<input type="text" class="form-control" ng-model="clickitem.create_date">
			</div>
			<div class="form-group" hidden>
				<label>เปลียน หมวดหมู่:</label>
				<input type="text" class="form-control" ng-model="clickitem.cat_id">
				<input type="text" class="form-control" ng-model="clickitem.cat_name">
			</div>
			<div class="form-group" hidden>
				<div class="form-group">
					<label>ประเภท:</label>
					<input type="text" class="form-control" ng-model="clickitem.type_id">
					<input type="text" class="form-control" ng-model="clickitem.type_name">
				</div>
				<div class="form-group" hidden>
					<label>ยี่ห้อ:</label>
					<input type="text" class="form-control" ng-model="clickitem.model_id">
					<input type="text" class="form-control" ng-model="clickitem.model_name">
				</div>
				<div class="form-group" hidden>
					<label>หน่วยนับ:</label>
					<input type="text" class="form-control" ng-model="clickitem.unit_id">
					<input type="text" class="form-control" ng-model="clickitem.unit_name">

				</div>
			</div>
			<div class="form-group">
				<label>ชื่ออุปกรณ์:</label>
				<input type="text" class="form-control" ng-model="clickitem.item_id" hidden>

				<input type="text" class="form-control" ng-model="clickitem.item_name" disabled>
			</div>
			<div class="form-group" hidden>
				<label>รายละเอียดการใช้งาน:</label>
				<input type="text" class="form-control" ng-model="clickitem.detail" disabled>
			</div>
			<div class="form-group">
				<label>จำนวนคงเหลือ: {{clickitem.in_use}}</label>
				<input type="text" class="form-control" ng-model="clickitem.in_use" disabled id="in_use" name="in_use">
			</div>


			<div class="form-group">
				<label>จำนวนที่ต้องการยืม:</label>
				<input type="number"   class="form-control input-no-spinner" ng-model="clickitem.num_request" id="num_request" name="num_request" > <p class="statusMsg"></p>
			</div>


		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">

				<button class="btn btn-default" ng-click="EditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				
				<button class="btn btn-success" id="additem" name="additem" ng-click="EditModal = false; updateitem();" disabled><span class=" glyphicon glyphicon-check"></span> Save</button>
			
			</div>
		</div>
	</div>
</div>



<!-- Edit Modal -->
<div class="myModal" ng-show="ListModal">

	<div class="modalContainer">
		<div class="editHeader" hidden>
			<span class="headerTitle">Edit item</span>
			<button class="closeEditBtn pull-right" ng-click="ListModal = false">&times;</button>
		</div>
		<div class="modalBody">

			
<div class="container">

<?php 
$sql2="SELECT * FROM borrow WHERE item_id = '{{clickitem.item_id}}' AND status='รอการอนุมัติ' ";
if ($res2 = mysqli_query($conn, $sql2)) { 
if (mysqli_num_rows($res2) > 0) {
while ($row = mysqli_fetch_array($res2)) { 
                                                   
                                           
$num_request = $row['num_request'];

@$num= $num + $num_request;
}}}


                                           
  ?>
  <h2>คิว</h2>	<input type="text" class="form-control" ng-model="clickitem.item_id" >
  <p>จำนวนการจองทั้งหมด : <?php echo @$num; ?>  </p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
   <?php
								$sql = "SELECT * FROM item 
                                        INNER JOIN category_type ON item.type_id=category_type.id
                                        INNER JOIN category ON item.cat_id=category.id
                                        INNER JOIN mem_type ON item.department=mem_type.mem_id
                                        ";
                                        if ($res = mysqli_query($conn, $sql)) { 
                                        if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_array($res)) { 
                                            ?>                           
                                  



                                        <td><img ng-src="<?php echo   $picture = $row['picture']; ?>" style="width: 128px;height: auto;" /></a></td>
                                        <td> <?php echo   $mem_type_department = $row['mem_type_department']; ?> </td>
                                        <td><?php echo   $item_name = $row['item_name']; ?> </td>
                                        <td><?php echo   $detail = $row['detail']; ?> </td>
                                        <td><?php echo   $serail = $row['serail']; ?> </td>
                                        <td><?php echo   $in_use = $row['in_use']; ?> </td></br>


                                        <?php 
                                        }}}
                                        ?>
  

    </tbody>
  </table>
</div>






		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="ListModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				
				<button class="btn btn-success" id="additem" name="additem" ng-click="ListModal = false; updateitem();" disabled><span class=" glyphicon glyphicon-check"></span> Save</button>
			
			</div>
		</div>
	</div>
</div>



<?php @include('filescript.php') ?>

<script type="text/javascript">


       $('#num_request').keyup(function() {
		var num_request = $(this).val();
		var in_use = parseInt(document.getElementById("in_use").value);

		if(num_request >= in_use){
			$('.statusMsg').html('<span style="color:red;">เกินจำนวนที่มีในสต็อก.</span>');
			document.getElementById("additem").disabled = true;

		}
		if(num_request <= in_use){
			$('.statusMsg').html('');
			document.getElementById("additem").disabled = false;
		}
			});


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