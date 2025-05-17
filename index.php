<?php
$playlistUrl = 'https://userx3565.hls-video.net/media2/token/a3f0c81db39d64f85b6f6a5cfaa1b2ce/stream.m3u8?token=7e95535326220e90013338b935f40476';

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

$ch = curl_init($playlistUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo "Error fetching playlist";
    exit;
}
curl_close($ch);

// Rewrite .ts segment URLs to point to local PHP proxy
$rewritten = preg_replace(
    '#https://userx3565\.hls-video\.net/ts1/token/[^/]+/([^?]+)\?token=[^\s\n]+#',
    'segment.php?file=$1',
    $response
);

header('Content-Type: application/vnd.apple.mpegurl');
echo $rewritten;
