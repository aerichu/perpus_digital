<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Print Result</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>judul</th>
                <th>penulis</th>
                <th>penerbit</th>
                <th>tahun_terbit</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($formulir)): ?>
                <?php foreach ($formulir as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $row->judul ?></td>
                        <td><?= $row->penulis ?></td>
                        <td><?= $row->penerbit ?></td>
                        <td><?= $row->tahun_terbit ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No data available for the selected date range.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
