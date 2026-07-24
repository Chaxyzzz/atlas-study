<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ATLAS Study - Users Report</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #ffffff;
            color: #000000;
            padding: 24px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 24px;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 1px;
        }
        .header p {
            margin: 4px 0 0 0;
            color: #666;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background: #f4f4f5;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
        }
        tr:nth-child(even) td {
            background: #fafafa;
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        @media print {
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">Print / Save PDF</button>

    <div class="header">
        <h1>ATLAS STUDY — USER MANAGEMENT REPORT</h1>
        <p>Generated on {{ date('d F Y, H:i') }} WIB | Total Users: {{ count($users) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Provider</th>
                <th>Role</th>
                <th>Lang</th>
                <th>Status</th>
                <th>Registration Date</th>
                <th>Last Login</th>
                <th>IP Address</th>
                <th>Device</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->username ? '@' . ltrim($user->username, '@') : '-' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ strtoupper($user->effective_provider) }}</td>
                    <td>{{ strtoupper($user->role ?: ($user->is_admin ? 'admin' : 'student')) }}</td>
                    <td>{{ strtoupper($user->preferred_language ?: 'id') }}</td>
                    <td>{{ strtoupper($user->status ?: 'active') }}</td>
                    <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                    <td>{{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : 'Never' }}</td>
                    <td>{{ $user->last_login_ip ?: '-' }}</td>
                    <td>{{ $user->device ?: '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
