<?php // include'conf.php'
include('conf.php');
session_start();

if (isset($_POST["action"])) {

  if ($_POST["action"] == !null) {

    $item_order=  $_POST["action"];
    $num_request=  $_POST["query"];

    $sql = "UPDATE borrow SET num_request = '$num_request' WHERE item_order = '$item_order'";
    $query = $conn->query($sql);

  
  }}

if (isset($_POST["borrow_topic"])){
  if ($_POST["borrow_topic"] == !null) {

  $borrow_bill=  $_POST["borrow_bill"];
  $borrow_topic=  $_POST["borrow_topic"];
  $borrow_date=  $_POST["borrow_date"];
  $return_date=  $_POST["return_date"];
  $detail=  $_POST["detail"];

  
 $sql = "UPDATE borrow_bill SET borrow_topic = '$borrow_topic', detail = '$detail' , borrow_date = '$borrow_date',return_date = '$return_date' WHERE borrow_bill = '$borrow_bill'";
  $query = $conn->query($sql);
 echo "update_bill";

}}

if (isset($_POST["delete_item"])) {

  if ($_POST["delete_item"] == !null) {

    $item_order=  $_POST["delete_item"];


       $sql = "DELETE FROM borrow WHERE item_order = '$item_order'";
        $query = $conn->query($sql);
        echo "delete_item";
     
  }}


?>