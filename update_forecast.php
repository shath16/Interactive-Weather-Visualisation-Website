<?php
require_once __DIR__ . '/includes/session.php';
require_admin(); //only admins can update forecast values 

header('Content-Type: application/json; charset=utf-8'); //fetch/AJAX

//only allows POST requests 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

//reading POST values sent from addweather.js
$idx    = trim($_POST['idx'] ?? '');
$time   = trim($_POST['time'] ?? '');
$city   = trim($_POST['city'] ?? '');
$metric = trim($_POST['metric'] ?? '');
$value  = trim($_POST['value'] ?? '');

//validating inputs 
if (!ctype_digit($idx)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid index']);
    exit;
}
if ($time === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Missing time']);
    exit;
}
if (!in_array($city, ['stoke', 'london'], true)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid city']);
    exit;
}
if (!in_array($metric, ['temp', 'humidity'], true)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid metric']);
    exit;
}
//value must be a numeric value 
if (!is_numeric($value)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Value must be numeric']);
    exit;
}
$value = (float)$value;
//value must be 0-100 for humidity 
if ($metric === 'humidity' && ($value < 0 || $value > 100)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Humidity must be 0–100']);
    exit;
}


//saving edits 
$file = __DIR__ . '/data/forecast_overrides.json';
$overrides = [];
if (file_exists($file)) {
    $decoded = json_decode(file_get_contents($file), true);
    if (is_array($decoded)) $overrides = $decoded;
}
$overrides[$city] ??= [];
$overrides[$city][$metric] ??= [];
$overrides[$city][$metric][$idx] = [
    'time'  => $time,
    'value' => $value
];


file_put_contents($file, json_encode($overrides, JSON_PRETTY_PRINT));

echo json_encode([
    'ok' => true,
    'city' => $city,
    'metric' => $metric,
    'idx' => (int)$idx,
    'time' => $time,
    'value' => $value
]);