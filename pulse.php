<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$token = "5c69b125-d00d-4a55-8b21-19f8bbd4e220"; // твой токен

$ch = curl_init("https://dev.pulsoid.net/api/v1/data/heart_rate");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $token
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo json_encode([
    "http_code" => $httpcode,
    "response" => json_decode($response, true)
]);
