<?php $stations = $data['stations'] ?? []; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Stations - Air Quality API</title>
    <style>
        body { font-family: Segoe UI, Arial, sans-serif; background: #f5f7fa; color: #222; }
        h1 { color: #286090; }
        table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 16px; box-shadow: 0 2px 12px #0001; }
        th, td { border: 1px solid #e0e0e0; padding: 10px 14px; text-align: left; }
        th { background: #286090; color: #fff; }
        tr:nth-child(even) { background: #f3f6fa; }
    </style>
</head>
<body>
    <h1>Stations</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        <?php foreach ($stations as $i => $station): ?>
        <tr>
        <td><?= htmlspecialchars($station['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($station['name'] ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
