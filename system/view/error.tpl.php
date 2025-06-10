<?php
header('Content-Type: application/json');
echo json_encode(['error' => $message], JSON_PRETTY_PRINT);
exit;
?>