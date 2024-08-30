<?php

header("Content-Type: application/json");

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "Mpesastkresponse.json";
$log = fopen($logFile,"a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$data = json_decode($stkCallbackResponse, true);

$MerchantRequestID = $data->Body->stkCallback->MerchantID;
$CheckoutRequestID = $data->BOdy->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->ResultCode;
$ResultDesc = $data->Body->stkCallback->$ResultDesc;
$CallbackMetadata = $data->Body->stkCallback->CallbackMetadata;

$AmountValue = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$PhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[3]->Value;

// CHECK IF TRANSACTION IS SUCCESSFUL
if ($ResultCode == 0) {
    // STORE THE TRANSACTION DETAILS IN THE DATABASE 
};