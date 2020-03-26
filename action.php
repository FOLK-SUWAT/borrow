<meta http-equiv="Content-type" content="text/html charset=utf-8">
<?php
@include("conf.php");

session_start();






if (isset($_POST["action"])) {

     unset($_SESSION["email"]);
     unset($_SESSION["member_id"]);
     unset($_SESSION["mem_name"]);
     unset($_SESSION["mem_type_id"]);
     unset($_SESSION["login"]);
     unset($_SESSION['cart']);
     unset($_SESSION['qty']);
     unset($_SESSION['department']);
     unset($_SESSION['borrow_order']);
     unset($_SESSION['mem_namecutstock']);
     unset($_SESSION['borrow_departmentcutstock']);
     unset($_SESSION['borrow_item_id']);
     unset($_SESSION['borrow_item_name']);
     unset($_SESSION['borrow_num_request']);
     unset($_SESSION['borrow_amount']);
     unset($_SESSION['borrow_status']);
     unset($_SESSION['borrow_topic']);
     unset($_SESSION['borrow_date']);
     unset($_SESSION['return_date']);
     unset($_SESSION['borrow_detail']);
     unset($_SESSION['borrow_id']);
     unset($_SESSION['department']);
     unset($_SESSION["borrow_edit_bill"]);
     unset($_SESSION["mem_id"]);
     session_destroy();
}



?>