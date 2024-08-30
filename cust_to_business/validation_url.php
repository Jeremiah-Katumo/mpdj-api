<?php

header("Content-Type: application/json");

$response = '{"ResultCode": 0, "ResultDesc": "Confirmation Received Successfuly."}';
$mpesaResponse = file_get_contents('php://input');
$logFile = "C2BValidationData.txt";
$jsonMpesaResponse = json_decode($mpesaResponse, true);
// $data = json_decode(file_get_contents('php://input'), true);
$log = fopen($logFile, "a");
fwrite($log, json_decode($mpesaResponse, true));
fclose($log);