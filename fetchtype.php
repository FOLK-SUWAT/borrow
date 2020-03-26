<?php
//fetch.php
@session_start();
$department =   $_SESSION["department"];

if (isset($_POST["action"])) {
    include('conf.php');
    $output = '';
    if ($_POST["action"] == "type_id") {


        $query = "SELECT *FROM category WHERE type_id = '" . $_POST["query"] . "'AND  mem_type_department = '$department'";
        $result = mysqli_query($conn, $query);
        $output .= '<option value="">เลือก หมวดหมู่:</option>';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<option value="' . $row["id"] . '">' . $row["cat_name"] . '</option>';
        }
    }



    echo $output;
}
