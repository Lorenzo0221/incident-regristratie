<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Incidenten Export</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2>Incidenten Export</h2>
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Locatie</th>
                <th>Datum</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidents as $incident)
            <tr>
                <td>{{ $incident->title }}</td>
                <td>{{ $incident->location }}</td>
                <td>{{ \Carbon\Carbon::parse($incident->incident_at)->format('d-m-Y H:i') }}</td>
                <td>{{ $incident->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>