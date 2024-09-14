<!DOCTYPE html>
<html>
<head>
    <title>Create Invoice</title>
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
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="container">
        <h1>Create Invoice for {{ $client->name }}</h1>
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <input type="hidden" name="client_id" value="{{ $client->id }}">

            <label for="service_id">Service:</label>
            <select id="service_id" name="service_id" required>
                @foreach($client->services as $service)
                    <option value="{{ $service->id }}">
                        {{ $service->service_name }} - ${{ $service->price }}
                    </option>
                @endforeach
            </select>

            <label for="total_price">Total Price:</label>
            <input type="text" id="total_price" name="total_price" value="{{ $client->services->sum('price') }}" readonly>

            <button type="submit">Create Invoice</button>
        </form>
    </div>
</body>
</html>
