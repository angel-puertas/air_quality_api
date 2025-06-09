<?php 
echo htmlspecialchars($data['message'] ?? $data['error'] ?? 'No result.');
?>