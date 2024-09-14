<!DOCTYPE html>
<html>
<head>
    <title>Jobs List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="container">
        <h1>Jobs List</h1>
        <a href="{{ route('jobs.create') }}">Create New Job</a>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Description</th>
                    <th>File</th>
                    <th>Client</th>
                    <th>Store</th>
                    <th>Employees</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->name }}</td>
                        <td>{{ $job->description }}</td>
                        <td>
                            @if($job->file_path)
                                <a href="{{ Storage::url($job->file_path) }}" target="_blank">View File</a>
                            @else
                                No file
                            @endif
                        </td>
                        <td>{{ $job->client->name }}</td>
                        <td>{{ $job->store->name ?? 'No store assigned' }}</td>
                        <td>
                            @if($job->employees->isEmpty())
                                No employees
                            @else
                                <ul>
                                    @foreach($job->employees as $employee)
                                        <li>{{ $employee->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('jobs.edit', $job) }}">Edit</a>
                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
