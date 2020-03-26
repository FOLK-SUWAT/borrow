<?php

include('conf.php');

session_start();
$department =   $_SESSION["department"];

date_default_timezone_set('Asia/Bangkok');
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
$path = 'img/image_item/'; // upload directory
if (
    !empty($_POST["item_name"]) ||
    !empty($_POST["detail"]) ||
    !empty($_POST["serail"]) ||
    !empty($_POST["create_date"]) ||
    !empty($_POST["cat_id"]) ||
    !empty($_POST["type_id"]) ||
    !empty($_POST["unit_name"]) ||
    !empty($_POST["in_use"]) ||
    !empty($_FILES['image'])
) {
    $item_name = $_POST['item_name'];
if(empty($item_name)){
                            
                        }else{

                            //Time Set day
                            $date = new DateTime();
                            $resultdate = $date->format('Y-m-d H:i:s');

                            //imge to sting
                            $img = $_FILES['image']['name'];
                            $tmp = $_FILES['image']['tmp_name'];
                            // get uploaded file's extension
                            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                            // can upload same image using rand function
                            $final_image = rand(1000, 1000000) . $img;
                            // check's valid format
                            if (in_array($ext, $valid_extensions)) {
                                $path = $path . strtolower($final_image);
                                if (move_uploaded_file($tmp, $path)) {
                                    $item_name = $_POST['item_name'];
                                    $detail = $_POST['detail'];
                                    $serail = $_POST['serail'];
                                    $create_date = $resultdate;
                                    $cat_id = $_POST['cat_id'];
                                    $type_id = $_POST['type_id'];
                                  
                                    $in_use = $_POST['in_use'];
                                    $department = $_SESSION["department"];
                                    //include database configuration file
                                    //insert form data in the database
                                    $insert = $conn->query("INSERT item (item_name,detail,serail,create_date,cat_id,type_id,in_use,department,picture)
                            VALUES ('" . $item_name . "','" . $detail . "','" . $serail . "','" . $create_date . "','" . $cat_id . "','" . $type_id . "','" . $in_use . "','" . $department . "','" . $path . "')");
                                    //echo $insert?'ok':'err';
                                }
                            } else {
                                $path = "";
                                $item_name = $_POST['item_name'];
                                $detail = $_POST['detail'];
                                $serail = $_POST['serail'];
                                $create_date = $resultdate;
                                $cat_id = $_POST['cat_id'];
                                $type_id = $_POST['type_id'];
                               
                                $in_use = $_POST['in_use'];
                                $department = $_SESSION["department"];

                                //include database configuration file
                                //insert form data in the database
                                $insert = $conn->query("INSERT item (item_name,detail,serail,create_date,cat_id,type_id,in_use,department,picture)
                                VALUES ('" . $item_name . "','" . $detail . "','" . $serail . "','" . $create_date . "','" . $cat_id . "','" . $type_id . "','" . $in_use . "','" . $department . "','" . $path . "')");
                                //echo $insert?'ok':'err';


                            }
                        }
}


echo "อัพเดตสำเร็จ";

/*
if (empty($_POST["item_name"])) {
    $out['item_name'] = true;
    $out['message'] = 'mem_name is required';
} elseif (empty($_POST["detail"])) {
    $out['detail'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_POST["serail"])) {
    $out['serail'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_POST["create_date"])) {
    $out['create_date'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_POST["cat_id"])) {
    $out['cat_id'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_POST["type_id"])) {
    $out['type_id'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_POST["model_id"])) {
    $out['model_id'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_POST["unit_id"])) {
    $out['unit_id'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_POST["in_use"])) {
    $out['in_use'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} elseif (empty($_FILES['image'])) {
    $out['image'] = true;
    $out['message'] = 'ต้องการที่อยู่อีเมล';
} else {

    //Time Set day
    $date = new DateTime();
    $resultdate = $date->format('Y-m-d H:i:s');

    //imge to sting
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000, 1000000) . $img;
    // check's valid format
    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);
        if (move_uploaded_file($tmp, $path)) {
            $item_name = $_POST['item_name'];
            $detail = $_POST['detail'];
            $serail = $_POST['serail'];
            $create_date = $resultdate;
            $cat_id = $_POST['cat_id'];
            $type_id = $_POST['type_id'];
            $model_id = $_POST['model_id'];
            $unit_id = $_POST['unit_id'];
            $in_use = $_POST['in_use'];
            $department = $_POST['department'];
            //include database configuration file
            //insert form data in the database
            $insert = $conn->query("INSERT item (item_name,detail,serail,create_date,cat_id,type_id,model_id,unit_id,in_use,department,picture)
     VALUES ('" . $item_name . "','" . $detail . "','" . $serail . "','" . $create_date . "','" . $cat_id . "','" . $type_id . "','" . $model_id . "','" . $unit_id . "','" . $in_use . "','" . $department . "','" . $path . "')");
            //echo $insert?'ok':'err';
        }
    } else {
        $path = "";
        $item_name = $_POST['item_name'];
        $detail = $_POST['detail'];
        $serail = $_POST['serail'];
        $create_date = $resultdate;
        $cat_id = $_POST['cat_id'];
        $type_id = $_POST['type_id'];
        $model_id = $_POST['model_id'];
        $unit_id = $_POST['unit_id'];
        $in_use = $_POST['in_use'];
        $department = $_POST['department'];

        //include database configuration file
        //insert form data in the database
        $insert = $conn->query("INSERT item (item_name,detail,serail,create_date,cat_id,type_id,model_id,unit_id,in_use,department,picture)
        VALUES ('" . $item_name . "','" . $detail . "','" . $serail . "','" . $create_date . "','" . $cat_id . "','" . $type_id . "','" . $model_id . "','" . $unit_id . "','" . $in_use . "','" . $department . "','" . $path . "')");
        //echo $insert?'ok':'err';


    }
}*/
