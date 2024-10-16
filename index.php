<?php
// Your ShipStation API credentials
$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

// The endpoint URL
$url = 'https://ssapi.shipstation.com/shipments/createlabel';

// The data to send in the request
$data = [
    'carrierCode' => 'ups',
    'serviceCode' => 'ups_ground',
    'packageCode' => 'package',
    'fromPostalCode' => 'V5K0A1',
    'toState' => 'ON',
    'toCountry' => 'CA',
    'toPostalCode' => 'M5V3L9',
    'weight' => [
        'value' => 5,
        'units' => 'pounds'
    ],
    'dimensions' => [
        'units' => 'inches',
        'length' => 10,
        'width' => 5,
        'height' => 8
    ],
    'confirmation' => 'delivery',
    'residential' => false
];

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($apiKey . ':' . $apiSecret)
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute the request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode the response
    $responseData = json_decode($response, true);
    print_r($responseData);
    // Extract the tracking number
    $trackingNumber = $responseData['trackingNumber'];
    echo 'Tracking Number: ' . $trackingNumber;
}

// Close cURL
curl_close($ch);
?>
