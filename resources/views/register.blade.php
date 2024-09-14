<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to your stylesheet -->

    <title>Register</title>
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
        input[type="text"], input[type="date"], input[type="time"], input[type="email"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px; /* Ensures consistent font size */
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
        .total-price {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Register</h1>
        @include('sidebar')
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" required>
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}">
            </div>

            <div class="form-group">
                <label for="appointment_time">Appointment Time:</label>
                <input type="time" id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}">
            </div>

            <div class="form-group">
                <label for="store_id">Select Store:</label>
                <select name="store_id" id="store_id" onchange="updateServices()">
                    <option value="">Select a store</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="services">Select Services:</label>
                <select name="services[]" id="services" multiple>
                    <!-- Services will be populated based on store selection -->
                </select>
            </div>

            <div class="total-price">
                Total Price: $<span id="total-price">0.00</span>
                <input type="hidden" name="total_price" id="total-price-input" value="0.00">
            </div>

            <button type="submit">Register</button>
        </form>
    </div>

    <script>
const servicesData = @json($services);

function updateServices() {
    const storeId = document.getElementById('store_id').value;
    const servicesDropdown = document.getElementById('services');
    const totalPriceElem = document.getElementById('total-price');
    const totalPriceInput = document.getElementById('total-price-input');

    // Clear previous options
    servicesDropdown.innerHTML = '';

    // Filter and populate services based on selected store
    const filteredServices = servicesData.filter(service => service.store_id == storeId);

    filteredServices.forEach(service => {
        const option = document.createElement('option');
        option.value = service.id;
        option.textContent = `${service.service_name} - $${service.price}`;
        option.dataset.price = service.price;
        servicesDropdown.appendChild(option);
    });

    // Update total price
    updateTotalPrice();
}

function updateTotalPrice() {
    const servicesDropdown = document.getElementById('services');
    const totalPriceElem = document.getElementById('total-price');
    const totalPriceInput = document.getElementById('total-price-input');

    let totalPrice = 0;
    Array.from(servicesDropdown.selectedOptions).forEach(option => {
        totalPrice += parseFloat(option.dataset.price);
    });

    totalPriceElem.textContent = totalPrice.toFixed(2);
    totalPriceInput.value = totalPrice.toFixed(2);
}

// Event listener for service selection change
document.getElementById('services').addEventListener('change', updateTotalPrice);

    </script>
</body>
</html>
