<?php $measurements = $data['measurements'] ?? []; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Measurements - Air Quality API</title>
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
    <h1>Measurements</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>StationID</th>
            <th>PolutantID</th>
            <th>Value</th>
            <th>Unit</th>
            <th>Time</th>
        </tr>
        <?php foreach ($measurements as $i => $measurement): ?>
        <tr>
            <td><?= htmlspecialchars($measurement['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($measurement['station_id'] ?? '') ?></td>
            <td><?= htmlspecialchars($measurement['polutant_id'] ?? '') ?></td>
            <td><?= htmlspecialchars($measurement['value'] ?? '') ?></td>
            <td><?= htmlspecialchars($measurement['unit'] ?? '') ?></td>
            <td><?= htmlspecialchars($measurement['time'] ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
