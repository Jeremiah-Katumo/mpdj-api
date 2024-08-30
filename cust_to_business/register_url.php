<?php
// Register URL API works hand in hand with Customer to Business (C2B) APIs and allows receiving 
// payment notifications to your paybill. This API enables you to register the callback URLs via 
// which you shall receive notifications for payments to your pay bill/till number.

$registerUrl = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
$BusinessShortCode = '174379';
$confirmationUrl = 'https://mydomain.com/confirmation_url.php';
$validationUrl = 'https://mydomain.com/validation_url.php';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $register);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization:Bearer' . $access_token));
$curl_post_data = array(
    'ShortCode' => $BusinessShortCode,
    'ResponseType' => 'Completed',
    'ConfirmationURL' => $confirmationUrl,
    'ValidationURL' => $validationUrl,
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

echo $curl_response;