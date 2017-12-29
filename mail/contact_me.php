<?php
require 'classi/PHPMailer.php';
require 'classi/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$email_subject = "Conferma Presenza Matrimonio:  $name";
$email_body = "$name\n ha confermato la presenza al matrimonio: $email_address\n\nPhone: $phone\n\n Messaggio:\n$message";

$mail = new PHPMailer(true);
$mail->isSMTP();

$mail->setFrom($email_address, $name);
$mail->addAddress('mabenett@gmail.com', 'Marco')
$mail->addAddress('chia.soriani@gmail.com', 'Chiara')

$mail->Subject = $email_subject;    
$mail->Body = $email_body;

if (!$mail->send()) {
    //The reason for failing to send will be in $mail->ErrorInfo
    //but you shouldn't display errors to users - process the error, log it on your server.
    $msg = 'Sorry, something went wrong. Please try again later.';
} else {
    $msg = 'Message sent! Thanks for contacting us.';
}
echo $msg;         
?>