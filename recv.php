<?php
require('twilio-php/Services/Twilio.php');

$sid = "AC19d4b688c588b4a5f631976d8ac62a64"; // Your Account SID from www.twilio.com/user/account
$token = "6d42cd04bbbdc0dc2580b59ac99aff95"; // Your Auth Token from www.twilio.com/user/account
$client = new Services_Twilio($sid, $token);

function startsWith($haystack, $needle)
{
    return !strncmp($haystack, $needle, strlen($needle));
}

// make an associative array of senders we know, indexed by phone number
$people = array(
    "5107478047" => "Adarsh Uppula",
    "+12223334444" => "Boots",
);

// if the sender is known, then greet them by name
// otherwise, consider them just another monkey
if (!$name = $people[$_REQUEST['From']]) {
    $name = "Person";
}

//logic
$resp = "body";
$phone = $_REQUEST['From'];
$pin = "54334";
$body = $_REQUEST['Body'];
$account = $phone . "@bitbank.com";

$sol = "6505333392";
$ada = "5107478047";

$recpt = $sol;

$fromSMS = "7077854717";

file_put_contents("log", $body . "\n");


$strmoney = file_get_contents("balance");
$totalmoney = (float) $strmoney;

if (startsWith(strtolower($body), "signup")) {
    $resp = "Your PIN: $pin, Your Bitbank Address: $account";
} else if (startsWith(strtolower($body), "send")) {
    $resp = "Please enter your PIN";
} else if (startsWith(strtolower($body), "balance")) {
    $resp = "Balance: " . $totalmoney . " BTC";
} else if (startsWith(strtolower($body), $pin)) {
    $resp = "Sent 1 BTC to $recpt. Transaction ID 34685";
    $message = $client->account->messages->sendMessage($fromSMS, $recpt, "Received 1 BTC from $phone. Transaction ID 34685");
    $s = file_put_contents("balance", "" . ($totalmoney + 1.0));
} else {
    $resp = "Incorrect PIN";
}

file_put_contents("reply", $resp . "\n");

// now greet the sender
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message><?php echo $resp ?></Message>
</Response>
