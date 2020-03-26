<?php

    $name   = $_POST['name'];
   $email  = $_POST['email'];
    $message= $_POST['message'];



require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->Debugoutput = 'html';

//SMTP Setting
include('configmaill.php');

//Body Setting
$mail->setFrom('booking.room@kice-center.com', 'Kice.E-borrow');
$mail->addAddress($email);
$body =$message ;
$mail->Subject = 'Subject';
$mail->msgHTML($body);
$mail->CharSet = 'UTF-8';



if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	
} else {
    echo "Message sent!";
    
}
?>