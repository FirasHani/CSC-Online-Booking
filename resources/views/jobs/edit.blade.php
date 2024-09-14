<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
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
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-bottom: 15px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="container">
        <h1>Edit Job</h1>
        <form action="{{ route('jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Job Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $job->name) }}" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required>{{ old('description', $job->description) }}</textarea>

            <label for="file">Upload New File (Leave blank to keep current):</label>
            <input type="file" id="file" name="file">

            <label for="client_id">Client:</label>
            <select id="client_id" name="client_id" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $job->client_id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
