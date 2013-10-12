<?php
require('twilio-php/Services/Twilio.php');

$sid = "AC19d4b688c588b4a5f631976d8ac62a64"; // Your Account SID from www.twilio.com/user/account
$token = "6d42cd04bbbdc0dc2580b59ac99aff95"; // Your Auth Token from www.twilio.com/user/account

$client = new Services_Twilio($sid, $token);

$to = $_GET["to"];

//froms
$sand = "4155992671";
$gotnum = "7077854717";

//ppl
$sol = "6505333392";
$ada = "5107478047";

$from = $gotnum;
if (empty($to)) {
    $to = $ada;
}

echo "Sending SMS from $from to $to ...<br/>";

$msg = "Hello monkey!";

$message = $client->account->messages->sendMessage(
    $from, // From a valid Twilio number
    $to, // Text this number
    $msg
);

file_put_contents("sent", $msg);

echo "Sent! Confirmation: " . $message->sid;


