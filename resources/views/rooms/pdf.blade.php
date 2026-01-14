<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rooms Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111827; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; }
        th { background: #eef2ff; font-weight: 700; }
        h1 { margin: 0; font-size: 20px; }
        small { color: #6b7280; }
    </style>
</head>
<body>
    <h1>Rooms Export</h1>
    <small>Generated at: {{ $generatedAt->format('M d, Y h:i A') }}</small>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Room Number</th>
                <th>Floor</th>
                <th>Status</th>
                <th>Room Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->floor }}</td>
                    <td>{{ ucfirst($room->status) }}</td>
                    <td>{{ $room->roomType?->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

