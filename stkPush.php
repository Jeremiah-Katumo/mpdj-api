<?php

include 'accessToken.php';

date_default_timezone_set('Africa/Nairobi');
$processRequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$CallbackUrl = '';
$PassKey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$BusinessShortCode = '174379';
$Timestamp = date('YmdHis');

// ENCRYPT DATA TO GET PASSWORD
$Password = base64_encode($BusinessShortCode . $PassKey . $Timestamp);
$phone = '254719395428';
$money = '1';
$PartyA = $phone;
$PartyB = '254708374149';
$AccountReference = 'TEXEXP ANALYTICS';
$TransactionDesc = 'stkpush test';
$Amount = $money;
$stkpushheader = ['Content-Type: application/json', 'Authorization:Bearer ' . $access_token];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader);
$curl_post_data = array(
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomPaybillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallbackUrl,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc,
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

echo $curl_response;