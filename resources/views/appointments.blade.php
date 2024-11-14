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

        #calendar {
            width:120vh;
            max-width: 200vh;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin:5vh 10vh 10vh 10vh;
        }

        /* Styling for FullCalendar events */
        .fc-event {
            background-color: #007bff; /* Blue background for events */
            color: #fff;
            border: none;
            padding: 5px;
            border-radius: 4px;
            font-weight: bold;
        }

        /* Custom tooltip style */
        .fc-event-title {
            font-size: 14px;
        }

        .fc-event-time, .fc-event-title, .fc-event-date {
            color: #fff; /* White font for event time and title */
        }

        /* Hover effect for calendar events */
        .fc-event:hover {
            background-color: #0056b3;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
    </head>
    <body>
        @include('sidebar')
        
        
        <div id="calendar">
        </div>
        <div style="width: 30vh; height: 10vh;padding:10vh 10vh 10vh 5vh;">
            
        <!--<button class="crudButtons" onclick="window.location.href='{{ url('viewAppointmentsRdn') }}'">View All Consultations</button>
                EDIT BUTTON IS HERERE-->


        </div>
        <script>

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                events: [
                    @foreach($appointments as $consultation)
                        {
                            title: '{{ $consultation->first_name ?? 'Unknown' }}', // Display first name
                            start: '{{ $consultation->start }}', // Full datetime (combined date + time)
                            extendedProps: {
                                customer_name: '{{ $consultation->first_name ?? 'Unknown' }}',
                                time: '{{ $consultation->formatted_time }}' // Formatted time (HH:mm)
                            }
                        }@if(!$loop->last),@endif
                    @endforeach
                ],
                eventContent: function(arg) {
                    // Custom display for event content as <first_name>,<time>
                    let customLabel = document.createElement('div');
                    customLabel.innerHTML = `<b>${arg.event.extendedProps.customer_name}, ${arg.event.extendedProps.time}</b>`;
                    
                    return { domNodes: [customLabel] };
                }
        });

        calendar.render();
    });

    </script>
</body>
</html>
