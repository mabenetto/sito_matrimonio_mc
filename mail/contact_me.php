<?php
header("access-control-allow-origin: *");

require_once("classi/classe_mail.php");





$dati_mittente = json_decode('{
    "mail_mitt": "info@marcoechiara2018.it",
    "nome_mitt": "App",
    "to": "info@marcoechiara2018.it",
    "server_smtp": "smtps.aruba.it",
    "username": "info@marcoechiara2018.it",
    "password": "pasquetta",
    "use_postman": false,
    "postman_client_id": "user_name",
    "postman_client_secret": "user_Secret"
    }');

$mail  = new classe_mail(0,false);

$nome = $_POST['name'];
$mail = $_POST['email'];
$message = $_POST['message'];
$token = $_POST['token'];


$mail->set_param($dati_mittente->nome_mitt, $dati_mittente->mail_mitt, $dati_mittente->server_smtp,465, true, $dati_mittente->username, $dati_mittente->password);

$mail->set_text("Conferma presenza da: ".$nome, "From:".$name."\n E-Mail: ".$email."\n Message:\n ".$message);
$mail->add_dest($dati_mittente->to);


if( $token == "mytokenmarcoechiara"){
	$esito = $mail->send();
}

echo json_encode(array("status"=>$esito));