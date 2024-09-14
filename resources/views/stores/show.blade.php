<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 80%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            font-size: 18px;
        }

        img {
            border-radius: 4px;
            margin-top: 20px;
            max-width: 100%;
            height: auto;
        }

        .actions {
            margin-top: 20px;
        }

        .actions a {
            color: #007bff;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .actions form {
            display: inline;
        }

        .actions button {
            padding: 10px 15px;
            background-color: #dc3545;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .actions button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="container">
        <h1>{{ $store->name }}</h1>
        <p><strong>Location:</strong> {{ $store->location }}</p>
        <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
        <div class="actions">
            <a href="{{ route('stores.index') }}">Back to List</a>
            <a href="{{ route('stores.edit', $store) }}">Edit</a>
            <form action="{{ route('stores.destroy', $store) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    </div>
</body>
</html>
