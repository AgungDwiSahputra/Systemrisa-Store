<?php

$apiKey = 'GHFoNp3KDfSsPHISmlPeHOCZXAFH0ykdXNCNIkok';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_FRESH_CONNECT     => true,
  CURLOPT_URL               => "https://payment.tripay.co.id/api/payment/channel",
  CURLOPT_RETURNTRANSFER    => true,
  CURLOPT_HEADER            => false,
  CURLOPT_HTTPHEADER        => array(
    "Authorization: Bearer ".$apiKey
  ),
  CURLOPT_FAILONERROR       => false
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

?>