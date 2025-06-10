<?php
echo htmlspecialchars(
    $data['message'] ??
    $data['general_error'] ??
    ($data['success'] === false && isset($data['errors']) ? implode(', ', $data['errors']) : 'No result.')
);
?>