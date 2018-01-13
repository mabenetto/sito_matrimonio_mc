<?php
header("access-control-allow-origin: *");






/*$dati_mittente = json_decode('{
    "mail_mitt": "info@marcoechiara2018.it",
    "nome_mitt": "App",
    "to": "info@marcoechiara2018.it",
    "server_smtp": "smtp.marcoechiara2018.it",
    "username": "info@marcoechiara2018.it",
    "password": "pasquetta",
    "use_postman": false,
    "postman_client_id": "user_name",
    "postman_client_secret": "user_Secret"
    }');
*/


$nome = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$token = $_POST['token'];



$to ="info@marcoechiara2018.it";
$subject = "Conferma presenza da: ".$nome;
$message = "From:".$nome."\n E-Mail: ".$email."\n Message:\n ".$message;
if(mail ($to, $subject, $message)){
	echo "OK";
}else{
	echo "KO";
}
