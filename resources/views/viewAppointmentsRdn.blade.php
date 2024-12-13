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
    <body style="overflow-x:hidden">
        @include('sidebar')
        
        <div class="container" style="margin:5vh 10vh 10vh 10vh;">
        <h1 class="text-center my-4">Consultation Schedule</h1>

        <!-- Search Input -->
<input type="text" id="searchInput" class="form-control" placeholder="Search Consultations...">
<div style="margin-bottom:3vh;"></div>
<!-- Table -->
<table id="consultationsTable" class="table table-bordered"  style="max-height: 60vh; height:60vh; overflow-y: auto; width:75vw;">
    <thead>
        <tr>
            <th>Consultation ID</th>
            <th>Time</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($consultations as $consultation)
            <tr>
                <td>{{ $consultation->consultation_sched_id }}</td>
                <td>{{ $consultation->time }}</td>
                <td>{{ $consultation->date }}</td>
                <td>{{ $consultation->customer->first_name ?? 'N/A' }} {{ $consultation->customer->last_name ?? 'N/A' }}</td>
                <td>{{ $consultation->notes }}</td>
                <td>
                    <a href="{{ route('viewAppointmentsRdnEdit.edit' , $consultation->consultation_sched_id) }}" class="btn btn-warning btn-sm">Add Note</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


        
        
    
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#consultationsTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

            

</script>
</html>
