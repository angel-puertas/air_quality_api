<?php
// Safe guard: ensure $data['resources'] is always an array
$resources = $data['resources'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Air Quality API Endpoints</title>
    <style>
        body {
            font-family: Segoe UI, Arial, sans-serif;
            margin: 30px;
            background: #f5f7fa;
            color: #222;
        }
        h1 {
            color: #286090;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 16px;
            box-shadow: 0 2px 12px #0001;
        }
        th, td {
            border: 1px solid #e0e0e0;
            padding: 10px 14px;
            text-align: left;
        }
        th {
            background: #286090;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f3f6fa;
        }
        .desc {
            color: #555;
            font-size: 0.97em;
        }
        .method-GET    { color: #36a27c; font-weight: bold; }
        .method-POST   { color: #357abD; font-weight: bold; }
        .method-PUT    { color: #e38d13; font-weight: bold; }
        .method-DELETE { color: #c12c2c; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Welcome!</h1>
    <table>
        <tr>
            <th>#</th>
            <th>Endpoint</th>
            <th>Method</th>
            <th>Body</th>
            <th>Description</th>
        </tr>
        <?php foreach ($resources as $key => $resource) { ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><strong><?= htmlspecialchars($resource['url']) ?></strong></td>
                <td class="method-<?= htmlspecialchars($resource['method']) ?>">
                    <?= htmlspecialchars($resource['method']) ?>
                </td>
                <td class="desc"><?= htmlspecialchars($resource['body'] ?? '') ?></td>
                <td class="desc"><?= htmlspecialchars($resource['description']) ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
