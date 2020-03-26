<?php
//fetch.php
if (isset($_POST["action"])) {
    include('conf.php');
    $output = '';
    if ($_POST["action"] == "type_idedit") {


        $query = "SELECT id,cat_name FROM category WHERE type_id = '" . $_POST["query"] . "'";
        $result = mysqli_query($conn, $query);
        $output .= '<option value="">เลือก ประเภท</option>';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<option value="' . $row["id"] .  '">' . $row["cat_name"] . '</option>';
        }
    }

    echo $output;
}
