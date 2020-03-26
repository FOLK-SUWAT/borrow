<?php
@include("conf.php");

$sql = "SELECT *  FROM borrow_bill";
$query = $conn->query($sql);

$num_rows = mysqli_num_rows($query);


while ($row = $query->fetch_array()) {
    $records[] = $row;
}

if (is_array($records)) {
    foreach ($records as $row) {
        $borrow_id = $row['borrow_id'];
        $borrow_bill = $row['borrow_bill'];
        $return_date = $row['return_date'];
        $borrow_date = $row['borrow_date'];
        $status_bill = $row['status_bill'];
        $borrow_department = $row['borrow_department'];
        $mem_name = $row['mem_name'];
        $member_id = $row['member_id'];
        if($status_bill =="อนุมัติ" ){
            $return_dateline= $return_date;
            $return_date = str_replace('-', '', $return_date);
            $return_date = substr($return_date,0,8);
            $todays = new DateTime();
            $todays = $todays->format('Y-m-d');
            $todays = str_replace('-', '', $todays);

            $resultdays= $return_date -  $todays;
          
            
              if($resultdays < 0){
                $query = "SELECT * FROM  mem_type WHERE mem_id = '$borrow_department'";

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);

                    $mem_type_department = $row['mem_type_department'];
                    $line_token = $row['line_token'];
                  
                  
                }
                $sql = "UPDATE borrow_bill SET status_bill = 'เลยกำหนดส่งคืน' WHERE borrow_bill = $borrow_bill";
                $query = $conn->query($sql);

                $sToken =   $line_token;
                $sMessage = "\n"  . 'แจ้งการยืมอุปกรณ์เกินกำหนด' . 
                "\n"  . 'เลขที่ใบยืม: ' .  $borrow_bill  .
                "\n"  . 'ชื่อผู้ยืม: ' . $mem_name  . 
                "\n"  . 'แผนกที่ยืม: ' .  $mem_type_department  . 
                "\n"  . 'วันที่ยืม: ' . $borrow_date  . 
                "\n"  . 'วันกำหนดคืน: ' . $return_dateline  .
                "\n";
                
                $chOne = curl_init(); 
                curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                curl_setopt( $chOne, CURLOPT_POST, 1); 
                curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
                $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
                curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                $result = curl_exec( $chOne ); 


                     $query = "SELECT * FROM  member WHERE member_id = '$member_id'";

                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);


                        $email = $row['email'];
                        $mem_name = $row['mem_name'];
                    
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
                                                            <center><h2><font color='red'>แจ้งการยืมอุปกรณ์เกินกำหนด </font> <strong style='color:#0000ff;'></strong></h2></center>
                                                            <p>เลขที่ใบยืม : $borrow_bill </p>
                                                            <p>ชื่อผู้ยืม : $mem_name </p>
                                                            <p>แผนกที่ยืม : $mem_type_department </p>
                                                            <p>วันที่ยืม : $borrow_date </p>
                                                            <p>วันกำหนดคืน : $return_dateline </p>

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
                        
                        
                    } else {
                       
                    }
             
                }
            }
           
        } 
    }


?>