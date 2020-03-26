<?php // include'conf.php'
include('conf.php');
session_start();
?>
<?php if ($_POST["item_order"] != null) { ?>
  <?php if ($_POST["amount"] != 0) {
       
      $itemsql = "SELECT * FROM item  WHERE item_id ='" . $_POST["item_id"] . "'";
      $itemsql_list = mysqli_query($conn, $itemsql);
      $row = mysqli_fetch_array($itemsql_list);

      if($row['in_use'] < $_POST["amount"]){
        $in = $row['in_use'] ;
        $message = "จำนวนอุปกรณ์ไม่พอ ";
        echo "<script type='text/javascript'>alert('$message คงเหลือ : $in ');</script>";
      } else if ($row['in_use'] >= $_POST["amount"]){
      $status = 'อนุมัติเรียบร้อย';
      $sendback = ("UPDATE borrow SET status ='" . $status . "', amount = '" . $_POST["amount"] . "' WHERE item_order='" .  $_POST["item_order"] . "'");
      $sendback_reslut = mysqli_query($conn, $sendback);

      //จำนวน คงเหลือ - ยืม ใน borrow
      $cutitem =  $row['in_use'] - $_POST["amount"];
      $cutitemsql = ("UPDATE item SET in_use ='" . $cutitem . "' WHERE item_id='" .  $_POST["item_id"] . "'");
      $cutitemsql_reslut = mysqli_query($conn, $cutitemsql);
      }

      ?>
    <script>
      window.onload = function() {
        window.location.replace("cutstock.php");
      }
    </script> 
  <?php } else if ($_POST["amount"] == 0) {
      $status = 'ไม่อนุมัติ';
      $sendback = ("UPDATE borrow SET status ='" . $status . "', amount = '" . $_POST["amount"] . "' WHERE item_order='" .  $_POST["item_order"] . "'");
      $sendback_reslut = mysqli_query($conn, $sendback); ?>
    <script>
      window.onload = function() {
        window.location.replace("cutstock.php");
      }
    </script>

<?php }
} else { } ?>


<?php if ($_POST["save"] != null) { ?>
  <?php if ($_POST["borrow_id"] != null) { 
    $check_submit = "SELECT * FROM borrow  WHERE borrow_id ='" . $_POST["borrow_id"] . "' AND status ='รอการอนุมัติ'";
    $submit_list = mysqli_query($conn, $check_submit);?>




      <?php if (mysqli_num_rows($submit_list) > 0){ ?>
          <script>
          window.onload = function() {
          window.location.replace("bill.php");}
          </script>




      <?php } else if (mysqli_num_rows($submit_list) <= 0)  { ?> 
        <?php $check = "SELECT * FROM borrow  WHERE borrow_id ='" . $_POST["borrow_id"] . "' AND status ='อนุมัติเรียบร้อย'";
          $check_list = mysqli_query($conn, $check); ?>




          <?php if (mysqli_num_rows($check_list) > 0) {
            $status = 'อนุมัติ';
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
                                                    <center><h2><font color='DodgerBlue'>แจ้งการอนุมัติอุปกรณ์ </font> <strong style='color:#0000ff;'></strong></h2></center>
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
                window.location.replace("bill.php");}
              </script>



          <?php } else if (mysqli_num_rows($check_list) <= 0) {
            $status = 'ไม่อนุมัติ';
            $sendback = ("UPDATE borrow_bill SET status_bill ='" . $status . "' WHERE borrow_bill='" .  $_POST["borrow_id"] . "'");
            $sendback_reslut = mysqli_query($conn, $sendback); ?>
              <script>
                window.onload = function() {
                window.location.replace("bill.php");}
            </script>
          <?php } ?>
      <?php } ?>




  <?php } ?>
<?php } ?>