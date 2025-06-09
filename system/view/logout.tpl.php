<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <h1>Logout</h1>
    <p><?= htmlspecialchars($data['message']) ?></p>
    <ul>
        <li><a href="?page=Login">Go to Login</a></li>
        <li><a href="?page=Index">Go to Index (Dashboard)</a></li>
    </ul>
</body>
</html>