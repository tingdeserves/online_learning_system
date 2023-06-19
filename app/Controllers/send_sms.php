

<?php
require '/var/www/htdocs/myproj/vendor/autoload.php';
use CodeIgniter\Exceptions\FrameworkException;
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
// To set up environmental variables, see http://twil.io/secure
$account_sid = 'AC9de86799722a0dc6c75a3a1dc0450c10';
$auth_token = '7e88e30336b873a3bcf9e683e31fa57c';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+16073643392";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+61420910347',
    array(
        'from' => $twilio_number,
        'body' => 'I sent this message in under 10 minutes!'
    )
);

//Python
//flask Framework
