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
$mail->Subject = "Peer Assessment account - Reminder";
$mail->WordWrap   = 80;
$content = "Dear Student ($username),<br/>
<br/>
You still have not completed your assessment for your group members in $groupname:</br>
<br/>
Please log into your Peer Assessment account at http://localhost/PeerAssessment/login.php and complete the assessment in order to view the average scores of you and your group members.
<br/>
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

}
?>
