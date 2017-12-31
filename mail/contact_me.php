<?php
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$from = $_POST['email']; 
$to = 'info@marcoechiara2018.it'; 
$subject = 'conferma invitato:'.$name;
$body = "From:".$name."\n E-Mail: ".$email."\n Message:\n ".$message;
mail($to,$subject,$body);
?>
