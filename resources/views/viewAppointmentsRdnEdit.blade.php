<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/rdnDash.css') }}">
    <style>

    </style>
    </head>
    <body>
        @include('sidebar')
        
        <div class="container"  style= "margin-left:3vh !important;">
        <h1 class="text-center my-4">Consultation Schedule</h1>

        <p>
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
                <label>Name</label><br>
                <input name="customer_id" value="{{ $consultation->customer_id }}"  type="hidden">

                <input name="customer_first_name" value="{{ $consultation->customer->first_name ?? 'Customer not found' }}" disabled>

                <input name="customer_last_name" value="{{ $consultation->customer->last_name ?? 'Customer not found' }}" disabled><br><br>

                <label>Date</label><br>
                <input type="date" name="date" id="date" class="form-control" 
                    value="{{ old('date', $consultation->date) }}" disabled><br><br>

                <label>Time</label><br>
                <input type="time" name="time" id="time" class="form-control" 
                    value="{{ old('time', $consultation->time) }}" disabled><br><br>

                <label>Notes</label><br>
                <textarea name="notes" class="form-control" rows="4">{{ $consultation->notes }}</textarea><br>
                <button class="crudButtons" style="height:5vh;width:15vh;margin-top:2vh;">Add Meal</button>
        </form>      
        </p>
        </div>
    </body>
<script>

            

</script>
</html>
