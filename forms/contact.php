<?php
  // Discord Webhook URL
  $discord_webhook_url = 'https://discord.com/api/webhooks/1260757099403804713/A-s-RE5auaX9Z3bAm85biOUyZofiCtTSCte7A3Pl4Cc4jDMHURbavQ7b7NKX1ohbQQAS';

  // Get the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Create the Discord embed
  $embed = [
    "embeds" => [
      [
        "title" => "New Contact Form Submission",
        "color" => 7506394,
        "fields" => [
          ["name" => "Name", "value" => $name, "inline" => true],
          ["name" => "Email", "value" => $email, "inline" => true],
          ["name" => "Subject", "value" => $subject, "inline" => false],
          ["name" => "Message", "value" => $message, "inline" => false]
        ],
        "footer" => ["text" => "Sent from Contact Form"]
      ]
    ]
  ];

  // Set up cURL
  $ch = curl_init($discord_webhook_url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($embed));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Execute the request and get the response
  $response = curl_exec($ch);
  
  // Check for cURL errors
  if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
  } else {
    echo 'Success: ' . $response;
  }

  curl_close($ch);
?>
