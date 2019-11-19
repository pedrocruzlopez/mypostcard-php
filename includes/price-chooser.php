<?php

require ('config.php');

header('Content-Type: application/json');
$id = $_POST['id'];
$type = $_POST['type'];

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, config('design_price_endpoint').$id);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$data_str = curl_exec($handle);
curl_close($handle);

$data = json_decode($data_str);

echo json_encode($data);

