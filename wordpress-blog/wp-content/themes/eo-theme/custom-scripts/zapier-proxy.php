<?php
// Allow requests from any origin (for development only, restrict in production)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Ensure the script runs only on POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Only POST requests are allowed']);
    exit;
}

// Get the incoming JSON payload
$data = file_get_contents('php://input');

// Validate JSON data (optional)
if (empty($data) || json_decode($data) === null) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid JSON payload']);
    exit;
}

// Zapier Webhook URL (replace with your actual Zapier Webhook URL)
$zapier_url = "https://hooks.zapier.com/hooks/catch/20875148/2is1ias/";

// Initialize cURL to forward the data to Zapier
$ch = curl_init($zapier_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

// Execute the request and capture the response
$zapier_response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

// Forward Zapier's response back to the client
http_response_code($http_status);
echo $zapier_response;
