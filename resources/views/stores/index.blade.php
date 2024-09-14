<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores</title>
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
            max-width: 1200px;
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .store-info {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .store-info img {
            border-radius: 4px;
            width: 100px;
            height: auto;
            margin-right: 15px;
        }

        .store-info div {
            display: flex;
            flex-direction: column;
        }

        .store-info strong {
            font-size: 18px;
            color: #333;
        }

        .store-info span {
            color: #777;
        }

        .actions {
            display: flex;
            align-items: center;
        }

        .actions a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .actions form {
            display: inline;
        }

        .actions button {
            padding: 5px 10px;
            background-color: #dc3545;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        .actions button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="container">
        <h1>Stores</h1>
        <a href="{{ route('stores.create') }}">Create New Store</a>
        <ul>
            @foreach ($stores as $store)
                <li>
                    <div class="store-info">
                        <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                        <div>
                            <strong>{{ $store->name }}</strong>
                            <span>{{ $store->location }}</span>
                        </div>
                    </div>
                    <div class="actions">
                        <a href="{{ route('stores.show', $store) }}">View</a>
                        <a href="{{ route('stores.edit', $store) }}">Edit</a>
                        <form action="{{ route('stores.destroy', $store) }}" method="POST">
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
