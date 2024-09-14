<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            margin-top: 0;
            color: #007bff;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
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
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="container">
        <h1>Create Service</h1>
        <form method="POST" action="{{ route('services.store') }}">
            @csrf

            <div class="form-group">
                <label for="service_name">Service Name:</label>
                <input type="text" name="service_name" id="service_name" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" required>
            </div>

            <div class="form-group">
                <label for="store_id">Store:</label>
                <select id="store_id" name="store_id" required>
                    <option value="">Select a Store</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>

       

            <button type="submit">Create</button>
        </form>
    </div>

    <script>
        document.getElementById('store_id').addEventListener('change', function() {
            var storeId = this.value;
            var serviceSelect = document.getElementById('existing_service');
            serviceSelect.innerHTML = '<option value="">Select a Service</option>'; // Reset the options

            if (storeId) {
                fetch(`/api/stores/${storeId}/services`)
                    .then(response => response.json())
                    .then(data => {
                        data.services.forEach(service => {
                            var option = document.createElement('option');
                            option.value = service.id;
                            option.textContent = service.service_name;
                            serviceSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
</body>
</html>
