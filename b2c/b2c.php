<?php

include '../authorization/accessToken.php';
include 'securitycredential.php';

$b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v3/paymentrequest';

$InitiatorName = 'testapi';
$InitiatorPassword = 'Safaricom999!*!';
$BusinessShortCode = '174379';
$Phone = '254708374149';
$Amountsend = '2';
$SecurityCredential = 'daA6XXaG9ht2CQLwzx8l/MGJJuVfoC8xOe4tiMOit2XdJsLd2Cssd+lxgtP3B/jM3F+c6RRwSyKtvJ2oB06YCZAH/79mqMOERv0LHfnfrARa651xvwN6L+sCOoiPhlpYFf+QarzkUDBAOjrzYYDyJd7YJ/WBVQ/AZcpyu3oIUUjrRxkWKIw/yy7tH5kWhJBzWgdPSfvaP2aZuOfDq/WM788D2HMedp71EfOCWj9UIjwyfNnvDNoRaF5bzJrVbn1W9ZF6y26Lq0j2X3Wf8Em5Q45VDa2PjZQ7UmP8mbZWJXn2uWjdL/u4Q2DgsA6ZpNwVDqv4F74k5VsyrI7EF9/5Tw==';
$CommandID = 'SalaryPayment'; // SalaryPayment, BusinessPayment, PromotionPayment
$Amount = $Amountsend;
$PartyA = $BusinessShortCode;
$PartyB = $Phone;
$Remarks = 'Texexp withdrawal';
$QueueTimeOutURL = '';
$ResultURL = '';
$Occasion = '';

$curl = curl_init();
$header = ["Content-Type: application/json", "Authorization: Bearer" . $access_token];
curl_setopt($curl, CURLOPT_URL, $b2c_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
$curl_post_data = array(
    'InitiatorName' => $InitiatorName,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL,
    'Occasion' => $Occasion
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

echo $curl_response;