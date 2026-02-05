
<?php
require_once __DIR__ . '/includes/session.php';
require_admin(); //only admins can update the weather data 

//read form input values 
$time = trim($_POST['time'] ?? '');
$temp = trim($_POST['temperature'] ?? '');
$hum  = trim($_POST['humidity'] ?? '');

//validation
if (!preg_match('/^\d{2}:\d{2}$/', $time)) {
    header('Location: submit.php');
    exit;
}

//temp and humidity must be numbers 
if (!is_numeric($temp) || !is_numeric($hum)) {
    header('Location: submit.php');
    exit;
}

$temp = (int)$temp;
$hum  = (int)$hum;

//humdity must be from 0-100%
if ($hum < 0 || $hum > 100) {
    header('Location: submit.php');
    exit;
}

//loading exisiting JSON file 
$file = __DIR__ . '/data/weather.json';
$data = ['time' => [], 'temperature' => [], 'humidity' => []];
if (file_exists($file)) {
    $decoded = json_decode(file_get_contents($file), true);
    if (is_array($decoded) && isset($decoded['time'], $decoded['temperature'], $decoded['humidity'])) {
        $data = $decoded;
    }
}

//checking if the time aready exists 
$idx = array_search($time, $data['time'], true);
if ($idx === false) {

    //for new time = add new value 
    $data['time'][] = $time;
    $data['temperature'][] = $temp;
    $data['humidity'][] = $hum;
} else {
    //for existing time = update the value 
    $data['temperature'][$idx] = $temp;
    $data['humidity'][$idx] = $hum;
}

//sort the entries in order of time 
$rows = [];
for ($i = 0; $i < count($data['time']); $i++) {
    $rows[] = [
        'time' => $data['time'][$i],
        'temperature' => $data['temperature'][$i],
        'humidity' => $data['humidity'][$i]
    ];
}
usort($rows, fn($a, $b) => strcmp($a['time'], $b['time']));

//reconstructing the arrays in a sorted order 
$data['time'] = array_column($rows, 'time');
$data['temperature'] = array_column($rows, 'temperature');
$data['humidity'] = array_column($rows, 'humidity');

//saving back to JSON 
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
header('Location: weather.php');
exit;
