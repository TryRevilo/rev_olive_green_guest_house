<?php
include 'rev_contact_us_email_html.php';
include 'rev_send_email_error.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$emailSendMessage = $_POST['message'];

$revSendBody = revEmailTemplate($name, $emailSendMessage, $email); 


$to      = 'info@olivegreenguesthouse.co.ke';
$headers = 'From: ' . $email . "\r\n" . 'Reply-To: info@olivegreenguesthouse.co.ke' . "\r\n" .'X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

if (mail($to, $subject, $revSendBody, $headers) && mail($email, $subject, $revSendBody, $headers)) {
   echo revEmailTemplate($name, $emailSendMessage, $email);
} else{
   echo revErrSendingEMail($emailSendMessage);
}
?>
