<!DOCTYPE html>
<html>
<head>
    <title>Clients List</title>
    <style>
        /* Basic styling */
        body {
            font-family: 'Roboto', sans-serif;
            background: url('https://example.com/path-to-your-image.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            color: #333333;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .container {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            max-width: 1200px;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            color: #333333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e2e6ea;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        td a:hover {
            color: #0056b3;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .container {
                margin-left: 0;
                width: 100%;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Navigation</h2>
        <a href="{{ route('employees.index') }}">Employees List</a>
        <a href="{{ route('services.index') }}">Services List</a>
        <a href="{{ route('stores.index') }}">Stores List</a>
        <a href="{{ route('clients.index') }}">Clients List</a>
        <a href="{{ route('jobs.index') }}">Jobs List</a>
        <a href="{{ route('invoices.index') }}">Invoices List</a>
        <a href="{{ route('appointments.index') }}">Appointments List</a>
        <a href="{{ route('email.index') }}">Settings</a>
    </div>

    <div class="container">
        <h1>Clients List</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Edit</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->location }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}">Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('appointments.email', $client->id) }}">Email</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
