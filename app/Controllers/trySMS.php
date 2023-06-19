<?php

# Citing code 
# The code snippet (1. send SMS using Vonage) below has been sourced from Vonage-Try the SMS API
# https://dashboard.nexmo.com/getting-started/sms
# The code snippet appears in its original form

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
# End code snippet (1. send SMS using Vonage)




#Citing code 

# The code snippet (2. output loop) below has been adapted from
# http://answers.unity3d.com/answers/221574/view.html
# I have changed variable types to output strings instead of numbers and adjusted the loop functionality

#(code here)

# End code snippet (2. output loop)

?>