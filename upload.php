<?php  
date_default_timezone_set('Asia/Bangkok');
include('conf.php');


$item_id = $_POST['item_id'];
 if(!empty($_FILES))  
 {  

                    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
                    $path = 'img/image_item/'; // upload directory




                //imge to sting
                $img = $_FILES['file']['name'];
                $tmp = $_FILES['file']['tmp_name'];
                // get uploaded file's extension
                $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                // can upload same image using rand function
                $final_image = rand(1000, 1000000) . $img;
                // check's valid format
                if (in_array($ext, $valid_extensions)) {
                    $path = $path . strtolower($final_image);
                    if (move_uploaded_file($tmp, $path)) {

                        $sql = "UPDATE item SET picture = '$path' WHERE item_id = '$item_id'";
                        $query = $conn->query($sql);

                        if(mysqli_query($conn, $sql))  
                        {  
                            echo 'File Uploaded';  
                        }  
                        else  
                        {  
                            echo 'File Uploaded But not Saved';  
                        }  


                    }
                } 

              

  





 }  
 else  
 {  
    echo 'Some Error'; 
 }  
 ?>  