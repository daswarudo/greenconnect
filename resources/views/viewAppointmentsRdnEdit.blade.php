<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Schedule</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/rdnDash.css') }}">
    <style>
        /* ✅ Container Styling */
        .container {
            width: 50vw;
            max-width: 800px;
            min-height: auto;
            padding: 25px;
            margin: 10vh auto;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ✅ Name Fields */
        .name-group {
            display: flex;
            width: 100%;
            gap: 10px;
        }

        .name-group input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* ✅ Date & Time Fields */
        .datetime-group {
            display: flex;
            width: 100%;
            gap: 10px;
        }

        .datetime-group input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* ✅ Labels */
        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            width: 100%;
            text-align: left;
        }

        /* ✅ Notes Field */
        textarea {
            width: 100%;
            height: 20vh;
            font-size: 16px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        /* ✅ Save Button */
        .crudButtons {
            width: 120px;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
            margin-top: 20px;
        }

        .crudButtons:hover {
            background-color: #0056b3;
        }

        /* ✅ Responsive Fixes */
        @media (max-width: 1024px) {
            .container {
                width: 70vw;
            }

            .name-group,
            .datetime-group {
                flex-direction: column;
            }
        }

        @media (max-width: 768px) {
            .container {
                width: 90vw;
                padding: 15px;
            }

            .crudButtons {
                width: 100px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    @include('sidebar')

    <div class="container">
        <h1>Consultation Schedule</h1>

        <form action="{{ route('consultations.update', $consultation->consultation_sched_id) }}" method="POST">
            @csrf
            @method('PUT')

            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if(Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Name Fields -->
            <label>Name</label>
            <div class="name-group">
                <input type="hidden" name="customer_id" value="{{ $consultation->customer_id }}">
                <input type="text" value="{{ $consultation->customer->first_name ?? 'Customer not found' }}" disabled>
                <input type="text" value="{{ $consultation->customer->last_name ?? 'Customer not found' }}" disabled>
            </div>

            <!-- Date & Time Fields -->
            <label>Date & Time</label>
            <div class="datetime-group">
                <input type="date" name="date" id="date" value="{{ old('date', $consultation->date) }}">
                <input type="time" name="time" id="time" value="{{ old('time', \Carbon\Carbon::parse($consultation->time)->format('H:i')) }}">
            </div>

            <!-- Notes Field -->
            <label>Notes</label>
            <textarea name="notes">{{ $consultation->notes }}</textarea>

            <!-- Save Button -->
            <button class="crudButtons">Save</button>
        </form>
    </div>
</body>
</html>
