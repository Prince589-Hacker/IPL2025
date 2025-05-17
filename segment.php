<?php
$token = '7e95535326220e90013338b935f40476';

if (!isset($_GET['file'])) {
    http_response_code(400);
    echo "Missing segment file";
    exit;
}

$segment = basename($_GET['file']);
$segmentUrl = "https://userx3565.hls-video.net/ts1/token/a3f0c81db39d64f85b6f6a5cfaa1b2ce/$segment?token=$token";

$headers = [
    "accept: *",
    "accept-encoding: gzip, deflate, br, zstd",
    "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
    "origin: https://userrr4591.ifrem.net",
    "priority: u=1, i",
    "referer: https://userrr4591.ifrem.net/",
    "sec-ch-ua: \"Google Chrome\";v=\"135\", \"Not-A.Brand\";v=\"8\", \"Chromium\";v=\"135\"",
    "sec-ch-ua-mobile: ?0",
    "sec-ch-ua-platform: \"Windows\"",
    "sec-fetch-dest: empty",
    "sec-fetch-mode: cors",
    "sec-fetch-site: cross-site",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36",
];

$ch = curl_init($segmentUrl);

// Set correct headers before any output
header('Content-Type: video/MP2T');

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_FILE, fopen('php://output', 'w')); // stream directly

$success = curl_exec($ch);

if (!$success) {
    http_response_code(500);
    echo "Error fetching segment";
}

curl_close($ch);
