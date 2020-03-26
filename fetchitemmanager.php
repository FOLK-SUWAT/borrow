<?php
include('conf.php');
session_start();
$department =   $_SESSION["department"];

if (isset($_SESSION['mem_type_id']) && ($_SESSION["mem_type_id"] == "MANAGER") or ($_SESSION["mem_type_id"] == "ADMIN")) {


    $output = array();
    $sql = "SELECT * FROM item 
    INNER JOIN category_type ON item.type_id=category_type.id
    INNER JOIN category ON item.cat_id=category.id
	INNER JOIN mem_type ON item.department=mem_type.mem_id
    WHERE item.department = '$_SESSION[department]'";

    /*$sql = "SELECT * FROM category_type INNER JOIN item ON item.type_id=category_type.type_id";   = '$_POST[data_type]'*/


    $query = $conn->query($sql);
    while ($row = $query->fetch_array()) {
        $output[] = $row;
    }
}


echo json_encode($output);
