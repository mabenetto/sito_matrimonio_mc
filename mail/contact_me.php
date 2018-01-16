<?php
require 'classi/classe_mysql.php';


$conn = new classe_DB('localhost', 'root', 'CoccoBim_91', 'chiara_marco');





$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$token = $_POST['token'];
$text = "Conferma presenza da: ".$name."<br> From: ".$name."<br> E-Mail: ".$email."<br><br> <b>Message<b>:<br> ".$message;


$sql = "INSERT into invitati (nome,email,message) value (:nome,:email,:message)";

$conn->esegui_query($sql, array($name, $email, $message));

// Replace path_to_sdk_inclusion with the path to the SDK as described in 
// http://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/basic-usage.html
define('REQUIRED_FILE','mail_aws/aws-autoloader.php'); 
                                                  
// Replace sender@example.com with your "From" address. 
// This address must be verified with Amazon SES.
define('SENDER', 'info@marcoechiara2018.it');           

// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
define('RECIPIENT', 'info@marcoechiara2018.it');    

// Specify a configuration set. If you do not want to use a configuration
// set, comment the following variable, and the 
// 'ConfigurationSetName' => CONFIGSET argument below.


// Replace us-west-2 with the AWS Region you're using for Amazon SES.
define('REGION','eu-west-1'); 

define('SUBJECT','Conferma presenza da: '.$name.'');

define('HTMLBODY',$text);
define('TEXTBODY',$text);

define('CHARSET','UTF-8');

require REQUIRED_FILE;

use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

$client = SesClient::factory(array(
    'profile'=>'default',
    'version'=> 'latest',     
    'region' => REGION
));

try {
     $result = $client->sendEmail([
    'Destination' => [
        'ToAddresses' => [
            RECIPIENT,
        ],
    ],
    'Message' => [
        'Body' => [
            'Html' => [
                'Charset' => CHARSET,
                'Data' => HTMLBODY,
            ],
			'Text' => [
                'Charset' => CHARSET,
                'Data' => TEXTBODY,
            ],
        ],
        'Subject' => [
            'Charset' => CHARSET,
            'Data' => SUBJECT,
        ],
    ],
    'Source' => SENDER,
]);
     $messageId = $result->get('MessageId');
     echo("Email sent! Message ID: $messageId"."\n");

} catch (SesException $error) {
     echo("The email was not sent. Error message: ".$error->getAwsErrorMessage()."\n");
}

?>
