<?php 
// Use this API to check the status of a Lipa Na M-Pesa Online Payment.

include '../authorization/accessToken.php';

date_default_timezone_set("Africa/Nairobi");
$queryUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
$BusinessShortCode = '174379';
$Timestamp = date('YmdHis');

$passKey ='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

// ENCRYPT DATA TO GET PASSWORD
$Password = base64_encode($BusinessShortCode . $passKey . $Timestamp);
// THIS IS THE UNIQUE ID THAT WAS GENERATED WHEN THE STK REQUEST INITIATED SUCCESSFULY
$CheckoutRequestID = '';    // this is obtained after the stk query is executed, the response body contains the CheckRequestID
$queryHeader = ["Content-Type: application/json", "Authorization: Bearer" . $access_token];

// Initiating the transaction
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $queryUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $queryHeader);
$curl_post_data = array(
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'CheckoutRequestID' => $CheckoutRequestID,
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
$data_to = json_encode($curl_response);


// if (isset($data_to->ResultCode)) {
//     $ResultCode = $data_to->ResultCode;
// };