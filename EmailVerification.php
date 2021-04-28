<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "service.noreply.peerassessment@gmail.com";
$mail->Password = "pa123456789pa";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->SetFrom("service-noreply@etutoringsystem.com");
$mail->AddAddress($email);
$mail->Subject = "Peer Assessment account - Registered";
$mail->WordWrap   = 80;
$content = "Hello,<br/>
<br/>
Thank you for registering with us. Please refer to the link below for your login portal<br/>
<br/>
Username: $username <br/>
Password: $passwordemail <br/>
<br/>
http://localhost/PeerAssessment/login.php<br/>
<br/>
If clicking the link doesn't work you can copy the link into your browser window or type it there directly.<br/>
<br/>
Regards,<br/>
<br/>
Your Peer Assessment System Support Team<br/>
-----------------------------<br/>"; 
$mail->MsgHTML($content);
$mail->IsHTML(true);
if(!$mail->Send()) 
{
$message = "Problem sending email.";
echo "<script type='text/javascript'>alert('$message');</script>";
}
else
{
$message = "You've successfully registered, please check your email.";
echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
