<?php
@include("conf.php");
@include("alert_line.php");

?>
    
<?php
session_start();
date_default_timezone_set('Asia/Bangkok');


// If form submitted, insert values into the database.
        if (isset($_POST['email'])){
            // removes backslashes
        $email = stripslashes($_REQUEST['email']);
            //escapes special characters in a string
        $email = mysqli_real_escape_string($conn,$email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn,$password);
        //Checking is user existing in the database or not
        $query = "  
        SELECT * FROM member  
        WHERE email = '" . $_POST["email"] . "'  
        AND password = '" . $_POST['password'] . "'LIMIT 1 
        ";
            $result = mysqli_query($conn,$query) or die(mysql_error());
            
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["member_id"] = $row["member_id"];
                    $_SESSION["mem_name"] = $row["mem_name"];
                    $_SESSION["mem_type_id"] = $row["mem_type_id"];
                    $_SESSION["department"] = $row["department"];
                   
                   
                // Redirect user to index.php
                unset($_SESSION["Unsuccess"]);


            }
            else{

                $_SESSION["Unsuccess"] = "email หรือ Password ของท่านไม่ถูกต้อง";
        }
        
        } 
      
      
?>

<!DOCTYPE html>
<html lang="th" ng-app="app">



<body ng-app="app" ng-controller="borrowdata" ng-init="fetch()">
    <!-- Navbar -->

    <nav class="navbar navbar-expand navbar-expand-sm nav_body ">
        <?php @include('navbar.php') ?>
    </nav>
    <!-- sidebar -->


    <nav class="navbar  navbar-expand-sm menu_body   ">
        <?php @include('sidebar.php') ;
        
        ?>
    </nav>

    <div id="wrapper">


        <!--check content -->

        <?php if(!isset($_SESSION['mem_type_id'])) { ?>

                <div id="content-wrapper">
                    <div class="container-fluid">
                        <div>
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header ">
                                        <h2 class="modal-title">&nbsp;Login</h2>
                                    </div><center>
                                    <div class='form '><span style='color:red;'>
                                    <?php echo @$_SESSION['Unsuccess'];  ?>
                                    </span></div></center>


                                          <div class="form modal-body">
                                                <form action="index.php" method="post" name="login">
                                                    <input type="text" name="email" class="form-control" placeholder="email" required />
                                                    <br />
                                                    <input type="password" name="password" class="form-control" placeholder="password" required />
                                                    <br />
                                                    <input name="submit" type="submit" class="btn btn-primary submitBtn" value="Login" />
                                                </form>
                                         </div>
                                            
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



        <?php }else if (isset($_SESSION['mem_type_id'])){ ?>

            <!-- content -->


            <div ng-controller="borrowdata" ng-init="fetch()">
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
                                    <h1 class="index_topic">บันทึกการยืมอุปกรณ์</h1>
                                </div>
                                <div class="col-md-3 row_search">
                                    <input type="text" ng-model="search" class="form-control textbox_search" placeholder="ค้นหาบันทึก">
                                </div>
                                <div class="col-md-2 row_btn ">
                                    <a ng-show="showborrow_bill" href="borrow.php"> <i class="fa fa-plus"></i> ยืมอุปกรน์ </a>
                                    <a ng-show="showborrow_item" ng-click="fetch();" class="btn btn-primary">กลับหน้าหลัก</a>
                                </div>

                            </div>


                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr ng-show="showborrow_bill">

                                        <th ng-click="sort('borrow_bill')" class="text-center"> หมายเลขใบยืม
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='borrow_bill'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='borrow_bill'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>

                                        <th ng-click="sort('borrow_topic')" class="text-center">หัวข้องานที่ยืม
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='borrow_topic'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='borrow_topic'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>
                                        <th ng-click="sort('borrow_date')" class="text-center">วันที่ยืม
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='borrow_date'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='borrow_date'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>

                                        <th ng-click="sort('return_date')" class="text-center">วันที่คืน
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='return_date'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='return_date'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>




                                        <th ng-click="sort('status')" class="text-center">สถานะ
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='status'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='status'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>

                                        <th class="text-center">Action</th>


                                    </tr>

                                    <tr ng-show="showborrow_item">



                                        <th ng-click="sort('item_name')" class="text-center">ชื่ออุปกรณ์
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='item_name'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='item_name'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>

                                        <th ng-click="sort('borrow_date')" class="text-center">จำนวนที่ต้องการยืม
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='borrow_date'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='borrow_date'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>

                                        <th ng-click="sort('amount')" class="text-center">จำนวนที่อนุมัติ
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='amount'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='amount'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>
                                        <th ng-click="sort('status')" class="text-center">สถานะ
                                            <span class="pull-right">
                                                <i class="fa fa-sort gray" ng-show="sortKey!='status'"></i>
                                                <i class="fa fa-sort" ng-show="sortKey=='status'" ng-class="{'fa fa-sort-asc':reverse,'fa fa-sort-desc':!reverse}"></i>
                                            </span>
                                        </th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <tr dir-paginate="borrow in borrow|orderBy:sortKey:reverse|filter:search|itemsPerPage:10">

                                        <td ng-if="borrow.item_order">{{ borrow.item_name }}</td>
                                        <td ng-if="borrow.item_order">{{ borrow.num_request }}</td>
                                        <td ng-if="borrow.item_order">{{ borrow.amount }}</td>
                                        <td ng-if="borrow.item_order">{{ borrow.status }}</td>



                                        <td ng-if="borrow.borrow_bill">{{ borrow.borrow_bill }}</td>
                                        <td ng-if="borrow.borrow_bill">{{ borrow.borrow_topic }}</td>
                                        <td ng-if="borrow.borrow_bill">{{ borrow.borrow_date }}</td>
                                        <td ng-if="borrow.borrow_bill">
                                            <span ng-if=" borrow.status_bill =='เลยกำหนดส่งคืน'" style="color:red"><i class="fa fa-calendar-times-o"></i> {{ borrow.return_date}} <i class="fa fa-calendar-times-o"></i></span>
                                            <span ng-if="borrow.status_bill !='เลยกำหนดส่งคืน'" style="color:green"> {{ borrow.return_date}}</span>
                                        </td>
                                        <td ng-if="borrow.borrow_bill">
                                           <span ng-if=" borrow.status_bill =='คืนอุปกรณ์ไม่ครบ'" style="color:red"> {{ borrow.status_bill}}</span>
                                            <span ng-if=" borrow.status_bill =='ไม่อนุมัติ'" style="color:red"> {{ borrow.status_bill}}</span>
                                            <span ng-if=" borrow.status_bill =='เลยกำหนดส่งคืน'" style="color:red"><i class="fa fa-calendar-times-o"></i> {{ borrow.status_bill}} <i class="fa fa-calendar-times-o"></i></span>
                                            <span ng-if="borrow.status_bill =='รอการอนุมัติ'" style="color:orange"> {{ borrow.status_bill}}</span>
                                            <span ng-if="borrow.status_bill =='คืนอุปกรณ์เรียบร้อย'" style="color:green"> {{ borrow.status_bill}}</span>
                                            <span ng-if="borrow.status_bill =='อนุมัติ'" style="color:green"> {{ borrow.status_bill}}</span>

                                        </td>
                                        <td>
                                            <form method="post" action="edit_bill.php"  >
                                                <button ng-if="borrow.status_bill" type="button" class="btn btn-success" ng-click="selectborrow(borrow); edititem();"> <i class="fa fa-eye"></i> view</button>
                                                
                                                <input type="hidden" name="borrow_bill" id="borrow_bill" class="form-control" value="{{ borrow.borrow_bill }}">
                                                <button ng-if="borrow.status_bill == 'รอการอนุมัติ'" type="submit" class="btn btn-success" ><i class="fa fa-edit"></i> Edit</button>
                                                
                                                <button ng-if="borrow.status_bill == 'รอการอนุมัติ'" type="button" class="btn btn-danger" ng-click="showDelete(); selectborrow(borrow);"> <i class="fa fa-trash"></i> Delete</button>

                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pull-right" style="margin-top:-10px;">
                                <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true">
                                </dir-pagination-controls>
                            </div>
                        </div>
                    </div>
                    <?php include('modalborrowlist.php'); ?>

                </div>
                <script src="dirPaginate.js"></script>
                <script src="borrowlist.js"></script>
            </div>






            <!--check content  login -->
        <?php } ?>




                                      

</body>




<?php @include('filescript.php') ?>
</html>
<script type="text/javascript">
	$('#ins_save').on("submit", function(e) {
		e.preventDefault();
		$.ajax({

			type: 'POST',
			url: 'edit_bill_fetch.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
                if(data == 'update_bill'){
                    alert("อัพเดตเรียบร้อย");
                }
			}
		});

    });
</script>
