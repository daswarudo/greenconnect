<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerDash.css') }}">

    <style>
        /* ✅ General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* ✅ Sidebar Styling (if applicable) */
        .content {
            flex-grow: 1;
            padding: 20px;
        }

        /* ✅ Header Styling */
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        /* ✅ Form Container */
        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* ✅ Form Headings */
        h2 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        /* ✅ Form Group Styling */
        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #444;
            display: block;
            margin-bottom: 5px;
        }

        /* ✅ Input Fields */
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        input[type="date"]:focus,
        input[type="time"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* ✅ Button Styling */
        .crudButtons {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .crudButtons:hover {
            background-color: #0056b3;
        }

        /* ✅ Success Message */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }

        /* ✅ Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
            }

            .crudButtons {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    @include('customerSidebar')

    <div class="content">
        <div class="header">
            <h1>
                <!-- WELCOME MESSAGE REMOVED -->
            </h1>
        </div>
        
        <div class="table-container"></div>

        <div class="container">
            <h2>Add a New Consultation</h2>

            <!-- Show success message if consultation is added -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Consultation Form -->
            <form action="{{ route('consultation.store') }}" method="POST">
                @csrf

                <!-- Hidden Customer ID (logged-in customer) -->
                <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">

                <!-- RDN ID (auto-filled, as there's only one RDN) -->
                <input type="hidden" name="rdn_id" value="{{ $rdnId }}">

                <!-- Date Input -->
                <div class="form-group">
                    <label for="date">Consultation Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>

                <!-- Time Input -->
                <div class="form-group">
                    <label for="time">Consultation Time</label>
                    <input type="time" name="time" id="time" class="form-control" required>
                </div>

                <!-- Submit Button -->
                <button class="crudButtons" type="submit" onclick="return confirm('Are you sure about that?')">Add Consultation</button>
            </form>
        </div>
    </div>
</body>
</html>
