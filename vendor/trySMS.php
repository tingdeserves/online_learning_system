<?php


require_once '/var/www/htdocs/myproj/vendor/autoload.php';

use Vonage\Client\Credentials\Basic;
use Vonage\Client;

$basic  = new \Vonage\Client\Credentials\Basic("2ff81d6e", "w8adzg5uKezyd0BZ");
$client = new \Vonage\Client($basic);




$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("61420910347", "abcd", 'A text message sent using the Nexmo SMS API')
);

$message = $response->current();

if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}




?>