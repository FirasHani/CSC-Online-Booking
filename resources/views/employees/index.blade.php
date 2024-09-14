<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        li:last-child {
            border-bottom: none;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions form {
            margin: 0;
        }
        .actions button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="container">
        <h1>Employees</h1>
        <a href="{{ route('employees.create') }}">Create New Employee</a>
        <ul>
            @foreach ($employees as $employee)
                <li>
                    <div>
                        <strong>{{ $employee->name }}</strong> - {{ $employee->email }} - {{ $employee->store->name }}
                    </div>
                    <div class="actions">
                        <a href="{{ route('employees.edit', $employee) }}">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
