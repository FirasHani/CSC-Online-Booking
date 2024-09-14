<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Email Editing</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .editable-text {
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            min-height: 100px;
            cursor: text;
        }
        .preview {
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
@include('sidebar')
    <h2>Edit and Preview Email Content</h2>
    
    <form id="email-form" method="POST"action="{{ route('appointments.saveContent', ['client_id' => $client->id]) }}">
        @csrf
        <div id="editable-content" class="editable-text" contenteditable="true">
            Dear <span id="client-name">{!! $clientName !!}</span>,<br><br>
            Hello Admin,<br><br>
            You have received a new appointment request.<br><br>
            Client Name: <span id="client-name">{!! $clientName !!}</span><br>
            Email: <span id="client-email">{!! $clientName !!}</span><br>
            Phone: <span id="client-phone">{!! $clientName !!}</span><br>
            Date & Time: <span id="appointment-date">{!! $clientName !!}</span> at <span id="appointment-time">{!! $clientName !!}</span><br><br>
            Please review the request and take necessary action.<br><br>
            Best regards,<br>
            <span id="branding-store">{!! $brandingStoreName !!}</span><br><br>
            <div id="dynamic-options-container"></div>
        </div>

        <div class="preview" id="email-preview">
        </div>

        <h3>Add New Option</h3>
        <div class="form-group">
            <label for="option-select">Select Option:</label>
            <select id="option-select" class="form-control">
                <option value="">Select...</option>
                <option value="Test 1: Test Value 1">Test 1</option>
                <option value="Test 2: Test Value 2">Test 2</option>
            </select>
        </div>
        <button type="button" id="add-option-button" class="button">Add Option</button>

        <input type="hidden" name="content" id="hidden-content" value="">
        <button type="submit" id="save-button" class="button">Save Changes</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editableDiv = document.getElementById('editable-content');
            const previewDiv = document.getElementById('email-preview');
            const dynamicOptionsContainer = document.getElementById('dynamic-options-container');
            const hiddenContentInput = document.getElementById('hidden-content');
            const form = document.getElementById('email-form');

            const updatePreview = () => {
                previewDiv.innerHTML = editableDiv.innerHTML;
            };

            const extractPlainText = (html) => {
                const doc = new DOMParser().parseFromString(html, 'text/html');
                return doc.body.innerText || "";
            };

            editableDiv.addEventListener('input', updatePreview);

            document.getElementById('add-option-button').addEventListener('click', () => {
                const optionSelect = document.getElementById('option-select');
                const selectedOption = optionSelect.value;

                if (selectedOption) {
                    const newOption = `<br>${selectedOption}`;
                    dynamicOptionsContainer.insertAdjacentHTML('beforeend', newOption);

                    updatePreview();
                    optionSelect.value = '';
                }
            });

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const content = editableDiv.innerHTML;
                const plainText = extractPlainText(content);
                hiddenContentInput.value = plainText; 
                form.submit(); 
            });
            updatePreview();
        });
    </script>
</body>
</html>
