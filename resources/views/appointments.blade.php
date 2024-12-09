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
            width:100vw;
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

    <script>
        /*
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
            left: 'prev,next today', // Include customButton beside "Today"
            center: 'title',
            right: 'customButton'
        },
        customButtons: {
            customButton: {
                text: 'View All Consultations',
                click: function () {
                    // Redirect to the consultations page
                    window.location.href = '{{ url('viewAppointmentsRdn') }}';
                }
            }
        },
            events: [
                @foreach($appointments as $consultation)
                    {
                        title: '{{ $consultation->first_name ?? 'Unknown' }} {{ $consultation->last_name ?? '' }}', // Display first and last name
                        start: '{{ $consultation->start }}', // Full datetime (combined date + time)
                        extendedProps: {
                            customer_name: '{{ $consultation->first_name ?? 'Unknown' }} {{ $consultation->last_name ?? '' }}',
                            time: '{{ $consultation->formatted_time }}', // Formatted time (HH:mm)
                            notes: '{{ $consultation->notes ?? 'No notes provided' }}' // Notes or default message
                        }
                    }@if(!$loop->last),@endif
                @endforeach
            ],
            eventContent: function(arg) {
                // Custom display for event content as <first_name> <last_name>, <time>
                let customLabel = document.createElement('div');
                customLabel.innerHTML = `<b>${arg.event.extendedProps.customer_name}, ${arg.event.extendedProps.time}</b>`;
                return { domNodes: [customLabel] };
            },
            dateClick: function(info) {
                // Action when a day is clicked
                alert('Date clicked: ' + info.dateStr);
                // Add logic to fetch and display events for the clicked day
            },
            eventClick: function(info) {
                // Action when an event is clicked
                let eventDetails = `
                    Customer Name: ${info.event.extendedProps.customer_name}
                    Time: ${info.event.extendedProps.time}
                    Date: ${info.event.start.toISOString().split('T')[0]}
                    Notes:${info.event.extendedProps.notes}
                `;
                // Display details (can be a modal or any other UI component)
                alert('Event Details:\n' + eventDetails);
            }
        });

        calendar.render();
    });*/
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    // Check if there are any events
    var events = [
        @foreach($appointments as $consultation)
            {
                title: '{{ $consultation->first_name ?? 'Unknown' }} {{ $consultation->last_name ?? '' }}', // Display first and last name
                start: '{{ $consultation->start }}', // Full datetime (combined date + time)
                extendedProps: {
                    customer_name: '{{ $consultation->first_name ?? 'Unknown' }} {{ $consultation->last_name ?? '' }}',
                    time: '{{ $consultation->formatted_time }}', // Formatted time (HH:mm)
                    notes: '{{ $consultation->notes ?? 'No notes provided' }}' // Notes or default message
                }
            }@if(!$loop->last),@endif
        @endforeach
    ];

    if (events.length === 0) {
        // If there are no events, display a message or keep the calendar empty
        calendarEl.innerHTML = '<p>No events available.</p>';
        return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today', // Include customButton beside "Today"
            center: 'title',
            right: 'customButton'
        },
        customButtons: {
            customButton: {
                text: 'View All Consultations',
                click: function () {
                    // Redirect to the consultations page
                    window.location.href = '{{ url('viewAppointmentsRdn') }}';
                }
            }
        },
        events: events, // Use the events array
        eventContent: function(arg) {
            // Custom display for event content as <first_name> <last_name>, <time>
            let customLabel = document.createElement('div');
            customLabel.innerHTML = `<b>${arg.event.extendedProps.customer_name}, ${arg.event.extendedProps.time}</b>`;
            return { domNodes: [customLabel] };
        },
        dateClick: function(info) {
            // Check if there are events on the clicked date
            var eventsOnDay = calendar.getEvents().filter(event => event.start.toISOString().split('T')[0] === info.dateStr);

            if (eventsOnDay.length > 0) {
                // If events exist on the clicked day, show the details
                alert('Date clicked: ' + info.dateStr);
            }
            // If no events exist for the clicked day, do nothing
        },
        eventClick: function(info) {
            // Action when an event is clicked
            let eventDetails = `
                Customer Name: ${info.event.extendedProps.customer_name}
                Time: ${info.event.extendedProps.time}
                Date: ${info.event.start.toISOString().split('T')[0]}
                Notes:${info.event.extendedProps.notes}
            `;
            // Display details (can be a modal or any other UI component)
            alert('Event Details:\n' + eventDetails);
        }
    });

    calendar.render();
});

</script>


</body>
</html>
