<!DOCTYPE html>
<html>
<head>
    <title>Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            margin-top: 0;
        }
        p {
            color: #28a745;
            font-weight: bold;
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
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }
        a:hover {
            text-decoration: underline;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .action-buttons button:hover {
            background-color: #c82333;
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
        
        <!-- Add other navigation links here -->
    </div>
    <div class="container">
        <h1>Appointments</h1>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        
        <table>
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Client Location</th>
                    <th>Service Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->client->name }}</td>
                        <td>{{ $appointment->client->email }}</td>
                        <td>{{ $appointment->client->location }}</td>
                        <td>{{ $appointment->service_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                        <!-- <td class="action-buttons">
                            <a href="{{ route('appointments.show', $appointment) }}">View</a>
                            <a href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->location }}</td>
                        <td>
                            @foreach ($client->services as $index => $service)
                                @if ($index > 0)
                                    ,
                                @endif
                                {{ $service->service_name }}
                            @endforeach
                        </td>
                        <td>{{ \Carbon\Carbon::parse($client->appointment_date)->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($client->appointment_time)->format('g:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('appointments.create') }}">Add New Appointment</a>
    </div>
</body>
</html>
