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

//mail($to,$subject,$body);


include("classi/PHPMailer.php"); // inclusione della classe PHPMailer
$mittente = "info@marcoechiara2018.it";
$nomemittente = "Marco e Chiara";
$to = 'info@marcoechiara2018.it'; 
$ServerSMTP = "smtps.aruba.it"; //server SMTP
$corpo_messaggio = "From:".$name."\n E-Mail: ".$email."\n Message:\n ".$message;

$msg = new PHPMailer;
$msg->IsSMTP(); // Utilizzo della classe SMTP al posto del comando php mail()
$msg->SMTPAuth = true; // Autenticazione SMTP
$msg->SMTPKeepAlive = "true";
$msg->Host = $ServerSMTP;
$msg->Username = "info@marcoechiara2018.it"; // Nome utente SMTP autenticato
$msg->Password = "pasquetta"; // Password account email con SMTP autenticato

$msg->Subject  = 'conferma invitato:'.$name;
$msg->From = $mittente;
$msg->FromName = $nomemittente;
$msg->AddAddress($destinatario); 
$msg->Body = $corpo_messaggio;
if(!$msg->Send()) {
echo "errore nella spedizione: ".$msg->ErrorInfo;
return false;
} else {
echo "Il messaggio di posta è stato inviato correttamente";
return true;
}

?>
