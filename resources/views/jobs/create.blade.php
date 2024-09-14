<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job</title>
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
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .total-price {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @include('sidebar')
    <div class="container">
        <h1>Create Job</h1>
        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Job Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="file">Upload File:</label>
            <input type="file" id="file" name="file">

            <label for="client_id">Client:</label>
            <select id="client_id" name="client_id" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>

            <label for="store_id">Store:</label>
            <select id="store_id" name="store_id" required onchange="updateFilters()">
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>

            <label for="employees">Employees:</label>
            <select id="employees" name="employee_ids[]" multiple>
                <!-- Options will be populated by JavaScript -->
            </select>

            <label for="services">Services:</label>
            <select id="services" name="service_ids[]" multiple>
                <!-- Options will be populated by JavaScript -->
            </select>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date">

            <label for="appointment_time">Appointment Time:</label>
            <input type="time" id="appointment_time" name="appointment_time">

            <button type="submit">Create</button>
        </form>
    </div>

    <script>
        // Assuming employees and services data are passed from the controller as JSON arrays
        const employeesData = @json($employees);
        const servicesData = @json($services);

        function updateFilters() {
            const storeId = document.getElementById('store_id').value;
            const employeesDropdown = document.getElementById('employees');
            const servicesDropdown = document.getElementById('services');

            // Clear previous options
            employeesDropdown.innerHTML = '';
            servicesDropdown.innerHTML = '';

            // Filter and populate employees based on selected store
            const filteredEmployees = employeesData.filter(employee => employee.store_id == storeId);
            filteredEmployees.forEach(employee => {
                const option = document.createElement('option');
                option.value = employee.id;
                option.textContent = employee.name;
                employeesDropdown.appendChild(option);
            });

            // Filter and populate services based on selected store
            const filteredServices = servicesData.filter(service => service.store_id == storeId);
            filteredServices.forEach(service => {
                const option = document.createElement('option');
                option.value = service.id;
                option.textContent = `${service.service_name} - $${service.price}`;
                option.dataset.price = service.price;
                servicesDropdown.appendChild(option);
            });
        }
    </script>
</body>
</html>
