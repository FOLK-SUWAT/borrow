<?php
include('conf.php');

?>

<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

			
<!-- Add Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->

			<div class="modalHeader">
			<span class="headerTitle">Add New category</span>
			<button type="button" class="close" data-dismiss="modal">
				Close
                    <span aria-hidden="true">&times;
                </button>
		</div>


		<p class="statusMsg"></p>

            
            <!-- Modal Body -->
            <div class="modal-body">
               
                <form role="form">
                    <div class="form-group">
					<label>หัวข้อการยืม:</label>
                        <input type="text" class="form-control" id="borrow_topic" placeholder=" " />
                    </div>
                    <div class="form-group">
					<label>รายละเอียดการใช้งาน:</label>
                        <input type="email" class="form-control" id="detail" >
                    </div>
					<div class="form-group">
						<p>วันที่ต้องการยืม:
						</p>
						<!--<input type="datetime-local" class="form-control" id="borrow_date" name="borrow_date" /> -->

						<div class="input-append date form_datetime">
							<input size="16" type="text" value="" readonly id="borrow_date" name="borrow_date"class="form-control">
							<span class="add-on"><i class="icon-th"></i></span>
						</div>
					</div>
					<div class="form-group">
						<p>วันที่ต้องคืน:
							<!--<input type="datetime-local" class="form-control" id="return_date" name="return_date" />-->
							<div class="input-append date form_datetime">
								<input size="16" type="text" value="" readonly id="return_date" name="return_date" class="form-control" >
								<span class="add-on"><i class="icon-th"></i></span>
							</div>
						</p>

					</div>

                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
                <button type="button" class="btn btn-primary" onclick="submitContactForm()">บันทึก</button>
            </div>
        </div>
    </div>
</div> 



<!-- Edit Modal -->
<div class="myModal" ng-show="EditModal">

	<div class="modalContainer">
		<div class="editHeader" hidden>
			<span class="headerTitle">Edit item</span>
			<button class="closeEditBtn pull-right" ng-click="EditModal = false">&times;</button>
		</div>
		<div class="modalBody">


			<div class="form-group">
				<label>จำนวนที่ต้องการยืม:</label>
				<input type="number" class="form-control" ng-model="clickitem.num_request" id="num_request" name="num_request" >
			</div>


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
			<span class="headerTitle">Delete cat</span>
			<button class="closeDelBtn pull-right" ng-click="DeleteModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">Are you sure you want to delete cat</h5>
			<h2 class="text-center">{{ clickitem.item_name }} </h2>
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

<!-- Delete Modal -->
<div class="myModal" ng-show="DeleteallModal">
	<div class="modalContainer">
		<div class="deleteHeader">
			<span class="headerTitle">Delete cat</span>
			<button class="closeDelBtn pull-right" ng-click="DeleteallModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">คุณต้องการลบรายการทั้งหมด ?</h5>
		
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" ng-click="DeleteallModal = false"><span class="glyphicon glyphicon-remove">
					</span> Cancel</button>
				<button class="btn btn-danger" ng-click="DeleteallModal = false; deleteallborrow(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>

<?php @include('filescript.php') ?>

<script>
function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var borrow_topic = $('#borrow_topic').val();
    var borrow_date = $('#borrow_date').val();
    var return_date = $('#return_date').val();
	var detail = $('#detail').val();
	if(borrow_topic.trim() == '' ){
			alert('กรุณาใส่ หัวข้อการยืม:');
			$('#borrow_topic').focus();
			return false;
	}else if(borrow_date.trim() == '' ){
			alert('กรุณาใส่ วันที่ต้องการยืม:');
			$('#borrow_date').focus();
			return false;
   	}else if(return_date.trim() == '' ){
			alert('กรุณาใส่ วันที่ต้องคืน:');
			$('#return_date').focus();
			return false;
   	}else if(detail.trim() == '' ){
			alert('กรุณาใส่ รายละเอียดการใช้งาน:');
			$('#detail').focus();
			return false;
   	}else{
        $.ajax({
            type:'POST',
            url:'addoder.php',
            data:'contactFrmSubmit=1&borrow_topic='+borrow_topic+'&borrow_date='+borrow_date+'&return_date='+return_date+'&detail='+detail,
			beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
			success:function(msg){

                alert(msg)
					var timer = setInterval(function () {
						
							
						window.location.reload(); 
				
				}, 500);


				
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
			
		});
	}
    
}
</script>





<script type="text/javascript">


	$('#ins_rec').on("submit", function(e) {
		e.preventDefault();
		$.ajax({

			type: 'POST',
			url: 'addoder.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
			
				$('#ins_rec').trigger('reset');
				$('#close_click').trigger('click');

				
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

<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>     
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>