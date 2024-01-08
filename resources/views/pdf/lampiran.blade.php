<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Disposisi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Lembar Disposisi</h2>
    <table>
        <tbody>
            <tr>
                <td>No Surat:</td>
                <td>{{ $disposisi->no_surat }}</td>
            </tr>
            <tr>
                <td>Keterangan:</td>
                <td>{{ $disposisi->keterangan }}</td>
            </tr>
            <tr>
                <td>Status Surat:</td>
                <td>{{ $disposisi->status_surat }}</td>
            </tr>
            <tr>
                <td>No Agenda:</td>
                <td>{{ $disposisi->no_agenda }}</td>
            </tr>
            <tr>
                <td>Tanggapan:</td>
                <td>{{ $disposisi->tanggapan }}</td>
            </tr>
            <tr>
                <td>Kepada:</td>
                <td>{{ $disposisi->kepada }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
