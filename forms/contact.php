<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

include '../rev_contact_us_email_html.php';

$to = 'info@olivegreenguesthouse.co.ke';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$emailSendMessage = $_POST['message'];

$revSendBody = revEmailTemplate($name, $emailSendMessage, $email); 

//Set PHPMailer to use the sendmail transport
$mail->isSendmail();
//Set who the message is to be sent from
$mail->setFrom($email, $name);
//Set an alternative reply-to address
$mail->addReplyTo($to, 'Olive Green Guest House');
//Set who the message is to be sent to
$mail->addAddress($to, 'Olive Green Guest House');
$mail->addAddress('tryRevilo@Yahoo.com', 'Olive Green Guest House');
$mail->addAddress($email, 'Olive Green Guest House');
//Set the subject line
$mail->Subject = $subject;
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($revSendBody);
//Replace the plain text body with one created manually
$mail->AltBody = $emailSendMessage;

//send the message, check for errors
if (!$mail->send()) {
  echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  echo 'OK';
}
?>
