<?php
error_reporting(E_ERROR | E_PARSE);
include 'api_keys.php';

    $key = $_GET['apiKey'];
    if (empty($key)) {
       echo "{\"error\":\"yes\",\"data\":\"API-Key was not given!\"}";
        exit;
    }
    if (!in_array($key, $Keys)) {
         echo "{\"error\":\"yes\",\"data\":\"API-Key is not valid!\"}";
        exit;
    }
    $host = $_GET['host'];
    if (empty($host)) {
        echo "{\"error\":\"yes\",\"data\":\"Missing Host\"}";
        exit;
    }
    if (!in_array($key, $bannedKeys)) {
    echo "{\"error\":\"yes\",\"data\":\"Your API-Key is banned! Please contact the support\"}";
    exit;
     }
     
    $url = "https://webresolver.nl/api.php?key=NR8S0-XIEDX-JJSQY-A5P0P&action=geoip&string=google.com".$host; // Change the URL to use your API
    $response = file_get_contents($url);
    echo $response;



$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$url = "https://discord.com/api/webhooks/"; // Your webhook
$negro = $_SESSION['username'];


$iplookup = file_get_contents("http://extreme-ip-lookup.com/json/{ip}");  // IP lookup

$hookObject = json_encode([
    "username" => "Logs",
    "avatar_url" => "https://cdn.discordapp.com/attachments/911373585715691561/911581146645659679/unknown.png",
    "tts" => false,
    "embeds" => [
        [
            "title" => "Key: $key",
            "type" => "rich",
            "description" => "** Host:** $host",
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