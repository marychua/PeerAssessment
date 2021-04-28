<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require 'PHPMailer/Exception.php';
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
$mail->Subject = "Peer Assessment account - Report";
$mail->WordWrap   = 80;
$content = "Hello,<br/>
<br/>
Congratulations! Your Group, $groupname, has completed the assessment. You may view your average grade below.<br/>
<br/>
Username: $username <br/>
Name: $firstname $lastname <br/>
Average Grade: *$avgmark%* <br/>
<br/>
<br/>
<br/><br/>
You can log into your Peer Assessment account at http://localhost/PeerAssessment/login.php to view more details.<br/>
<br/>
If clicking the link does not work, please contact your tutor.<br/>
<br/>
Yours sincerely,<br/>
<br/>
<br/>
Your Tutor <br/>
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
header('Location: tutorHomepage.php');
$message = "You've successfully registered, please check your email.";
echo "<script type='text/javascript'>alert('$message');</script>";
header('Location: tutorHomepage.php');
}
?>
