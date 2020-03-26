<?php // include'conf.php'
include('conf.php');
session_start();
?>
<?php if ($_POST["item_order"] != null) { ?>
  <!--คืนอุปกรณ์เรียบร้อย-->
  <?php if ($_POST["num_sendback"] == $_POST["amount"]) {

        $item_order=$_POST["item_order"];
        $send_history = $_POST["num_sendback"];
        @$history='';
        @$history1='';
        $query = "SELECT * FROM  send_history WHERE item_order= $item_order";
                  
        $result = mysqli_query($conn, $query);
        while ($row = $result->fetch_array()) {
          $historyquery[] = $row;
        }

        if (is_array($historyquery)) {

          foreach ($historyquery as $row) {
            $history = $row['history'];

            $history1= $history1+$history;

          }
        }



        $historytotal=$send_history-$history1;


        $sql = "INSERT INTO send_history (item_order,history) 
        VALUES ('$item_order','$historytotal')";
        $query = $conn->query($sql);


      $itemsql = "SELECT * FROM item  WHERE item_id ='" . $_POST["item_id"] . "'";
      $itemsql_list = mysqli_query($conn, $itemsql);
      $row = mysqli_fetch_array($itemsql_list);

      $status = 'คืนอุปกรณ์เรียบร้อย';
      $sendback = ("UPDATE borrow SET status ='" . $status . "', num_sendback = '" . $_POST["num_sendback"] . "'  WHERE item_order='" .  $_POST["item_order"] . "'");
      $sendback_reslut = mysqli_query($conn, $sendback);

      //จำนวน คงเหลือ + คืน ใน item
      $additem =  $row['in_use'] + $_POST["num_sendback"];
      $additemsql = ("UPDATE item SET in_use ='" . $additem . "' WHERE item_id='" .  $_POST["item_id"] . "'");
      $additemsql_reslut = mysqli_query($conn, $additemsql);
      ?>
    <script>
      window.onload = function() {
        window.location.replace("addstock.php");
      }
    </script>
    <!--คืนอุปกรณ์ไม่ครบ-->
  <?php } else if ($_POST["num_sendback"] < $_POST["amount"]) {

      $item_order=$_POST["item_order"];
      $send_history = $_POST["num_sendback"];
      @$history='';
      @$history1='';
      $query = "SELECT * FROM  send_history WHERE item_order= $item_order";
                
      $result = mysqli_query($conn, $query);
      while ($row = $result->fetch_array()) {
        $historyquery[] = $row;
    }
    
      if (is_array($historyquery)) {

        foreach ($historyquery as $row) {
          $history = $row['history'];

          $history1= $history1+$history;
    
        }
    }



      if($history1 >0){
        $historytotal=$send_history-$history1;

      }else{
        $historytotal=$send_history;
      };

      $sql = "INSERT INTO send_history (item_order,history) 
      VALUES ('$item_order','$historytotal')";
      $query = $conn->query($sql);


 
      
      $status = 'คืนอุปกรณ์ไม่ครบ';
      $sendback = ("UPDATE borrow SET status ='" . $status . "', num_sendback = '" . $_POST["num_sendback"] . "'   WHERE item_order='" .  $_POST["item_order"] . "'");
      $sendback_reslut = mysqli_query($conn, $sendback);
      ?>
    <script>
      window.onload = function() {
        window.location.replace("addstock.php");
      }
    </script>
<?php } else if ($_POST["num_sendback"] > $_POST["amount"]) { 
  
  $in = $row['in_use'] ;
  $message = "จำนวนการคืนไม่ถูกต้อง ";
  echo "<script type='text/javascript'>alert('$message');</script>";
  
  ?>
  

  <?php } 
} else { } ?>

<?php if ($_POST["save"] != null) { ?>
  <?php if ($_POST["borrow_id"] != null) {
      $check = "SELECT * FROM borrow  WHERE borrow_id ='" . $_POST["borrow_id"] . "' AND status ='คืนอุปกรณ์ไม่ครบ'";
      $check_list = mysqli_query($conn, $check); ?>



    <?php if (mysqli_num_rows($check_list) > 0) {
          $status = 'คืนอุปกรณ์ไม่ครบ';
          $sendback = ("UPDATE borrow_bill SET status_bill ='" . $status . "' WHERE borrow_bill='" .  $_POST["borrow_id"] . "'");
          $sendback_reslut = mysqli_query($conn, $sendback);
          
          
          
          
           
          
          $query1 = "SELECT * FROM  borrow_bill 
            INNER JOIN member ON member.member_id=borrow_bill.member_id
            INNER JOIN mem_type ON mem_type.mem_id=borrow_bill.borrow_department

            WHERE borrow_bill.borrow_bill = '" .  $_POST["borrow_id"] . "' ";

            $result1 = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result1) > 0) {
                $rowq = mysqli_fetch_array($result1);
                $email = $rowq['email'];
                $borrow_topic = $rowq['borrow_topic'];
                $mem_name = $rowq['mem_name'];
                $borrow_date = $rowq['borrow_date'];
                $return_date = $rowq['return_date'];
                $mem_type_department = $rowq['mem_type_department'];
                $borrow_bill = $rowq['borrow_bill'];
            }
            


                $email_content = "
                                    <!DOCTYPE html>
                                    <html>
                                        <head>
                                            <meta charset=utf-8>
                                            <title>ทดสอบการส่ง Email</title>
                                        </head>
                                        <body>

                                            </h1>
                                            <div style='padding:20px;'>
                                                <div style='text-align:center;margin-bottom:5px;'>
                                                </div>
                                                <center> <img src='cid:kicelogo' style='width:12px%' />	</center>
                                                <div>				
                                                    <center><h2><font color='red'>แจ้งการคืนอุปกรณ์ไม่ครบ</font> <strong style='color:#0000ff;'></strong></h2></center>
                                                    <p>หัวข้องานที่ยืม	 : $borrow_topic </p>
                                                    <p>เลขที่ใบยืม : $borrow_bill </p>
                                                    <p>ชื่อผู้ยืม : $mem_name </p>
                                                    <p>แผนกที่ยืม : $mem_type_department </p>
                                                    <p>วันที่ยืม : $borrow_date </p>
                                                    <p>วันกำหนดคืน : $return_date </p>

                                                </div>
                                                <div style='margin-top:30px;'>
                                                    <hr>
                                                    <address>
                                                        
                                                    </address>
                                                </div>
                                            </div>
                                            <div style='background: #33ccff;color: #a2abb7;padding:30px;'>
                                                <div style='text-align:center'> 
                                                    
                                                </div>
                                            </div>
                                        </body>
                                    </html>
                                    ";

            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';

          //SMTP Setting
          include('configmaill.php');
        


            //Body Setting
            $mail->setFrom('booking.room@kice-center.com', 'Kice.E-borrow');
            $mail->addAddress($email);
            $mail->AddEmbeddedImage('img/kicelogo1.png', 'kicelogo');
            $body =$email_content ;
            $mail->Subject = 'Subject';
            $mail->msgHTML($body);
            $mail->CharSet = 'UTF-8';

            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                
            } else {
                echo "Message sent!";
            }
          
          
          
          
          
          
          ?>
      <script>
        window.onload = function() {
          window.location.replace("bill.php");
        }
      </script>



    <?php } else if (mysqli_num_rows($check_list) <= 0) {



          $status = 'คืนอุปกรณ์เรียบร้อย';
          $sendback = ("UPDATE borrow_bill SET status_bill ='" . $status . "' WHERE borrow_bill='" .  $_POST["borrow_id"] . "'");
          $sendback_reslut = mysqli_query($conn, $sendback); 
          
          
          
          
          $query1 = "SELECT * FROM  borrow_bill 
            INNER JOIN member ON member.member_id=borrow_bill.member_id
            INNER JOIN mem_type ON mem_type.mem_id=borrow_bill.borrow_department

            WHERE borrow_bill.borrow_bill = '" .  $_POST["borrow_id"] . "' ";

            $result1 = mysqli_query($conn, $query1);
            if (mysqli_num_rows($result1) > 0) {
                $rowq = mysqli_fetch_array($result1);
                $email = $rowq['email'];
                $borrow_topic = $rowq['borrow_topic'];
                $mem_name = $rowq['mem_name'];
                $borrow_date = $rowq['borrow_date'];
                $return_date = $rowq['return_date'];
                $mem_type_department = $rowq['mem_type_department'];
                $borrow_bill = $rowq['borrow_bill'];
            }
            


                $email_content = "
                                    <!DOCTYPE html>
                                    <html>
                                        <head>
                                            <meta charset=utf-8>
                                            <title>ทดสอบการส่ง Email</title>
                                        </head>
                                        <body>

                                            </h1>
                                            <div style='padding:20px;'>
                                                <div style='text-align:center;margin-bottom:5px;'>
                                                </div>
                                                <center> <img src='cid:kicelogo' style='width:12px%' />	</center>
                                                <div>				
                                                    <center><h2><font color='green'>แจ้งการคืนอุปกรณ์เรียบร้อย </font> <strong style='color:#0000ff;'></strong></h2></center>
                                                    <p>หัวข้องานที่ยืม	 : $borrow_topic </p>
                                                    <p>เลขที่ใบยืม : $borrow_bill </p>
                                                    <p>ชื่อผู้ยืม : $mem_name </p>
                                                    <p>แผนกที่ยืม : $mem_type_department </p>
                                                    <p>วันที่ยืม : $borrow_date </p>
                                                    <p>วันกำหนดคืน : $return_date </p>

                                                </div>
                                                <div style='margin-top:30px;'>
                                                    <hr>
                                                    <address>
                                                        
                                                    </address>
                                                </div>
                                            </div>
                                            <div style='background: #33ccff;color: #a2abb7;padding:30px;'>
                                                <div style='text-align:center'> 
                                                    
                                                </div>
                                            </div>
                                        </body>
                                    </html>
                                    ";

            require 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';

          //SMTP Setting
          include('configmaill.php');
        


            //Body Setting
            $mail->setFrom('booking.room@kice-center.com', 'Kice.E-borrow');
            $mail->addAddress($email);
            $mail->AddEmbeddedImage('img/kicelogo1.png', 'kicelogo');
            $body =$email_content ;
            $mail->Subject = 'Subject';
            $mail->msgHTML($body);
            $mail->CharSet = 'UTF-8';

            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                
            } else {
                echo "Message sent!";
            }
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          ?>
      <script>
        window.onload = function() {
          window.location.replace("bill.php");
        }
      </script>
    <?php   }    ?>


  <?php } ?>
<?php } ?>