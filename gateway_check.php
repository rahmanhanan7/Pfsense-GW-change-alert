#!/usr/local/bin/php
<?php
// Get the current default gateway
$current_gateway = exec("netstat -rn | grep default | awk '{print $2}'");

// Read the previously saved gateway from a file
$previous_gateway_file = "/root/previous_gateway.txt";
$previous_gateway = file_exists($previous_gateway_file) ? file_get_contents($previous_gateway_file) : '';

// Google Chat webhook URL
$google_chat_webhook_url = "YOUR GOOGLE WEBHOOK HERE";

// Mapping of gateways to their names
$gateway_names = [
    "GW IP" => "GW1 Name",
    "GW IP" => "GW2 Name"
];

// Determine the name of the current gateway
$current_gateway_name = isset($gateway_names[$current_gateway]) ? $gateway_names[$current_gateway] : $current_gateway;

// Check if the gateway has changed
if ($current_gateway != $previous_gateway) {
    // Determine the name of the previous gateway
    $previous_gateway_name = isset($gateway_names[$previous_gateway]) ? $gateway_names[$previous_gateway] : $previous_gateway;

    // Create the message payload for Google Chat
    $message = json_encode([
        'text' => "Default gateway changed from $previous_gateway_name to $current_gateway_name"
    ]);

    // Send a cURL request to Google Chat
    $ch = curl_init($google_chat_webhook_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($message)
    ]);
    curl_exec($ch);
    curl_close($ch);

    // Update the file with the new gateway
    file_put_contents($previous_gateway_file, $current_gateway);
}
?>
