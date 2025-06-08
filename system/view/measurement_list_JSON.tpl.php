<?php 
header('Content-Type: application/json');
$measurements = $data['measurements'] ?? [];
echo json_encode($measurements, JSON_PRETTY_PRINT);
?>