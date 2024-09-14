<!DOCTYPE html>
<html>
<head>
    <title>Create Appointment</title>
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
        select, input[type="date"], input[type="time"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
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
        <h1>Create Appointment</h1>
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf

            <div class="form-group">
                <label for="client_id">Client:</label>
                <select name="client_id" id="client_id" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="service_name">Service Name:</label>
                <select name="service_name" id="service_name" required>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                    @endforeach   
                </select>
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" name="appointment_date" id="appointment_date" required>
            </div>

            <div class="form-group">
                <label for="appointment_time">Appointment Time:</label>
                <input type="time" name="appointment_time" id="appointment_time" required>
            </div>

            <button type="submit">Create Appointment</button>
        </form>
    </div>
</body>
</html>
