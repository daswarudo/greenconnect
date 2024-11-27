<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    

    <link rel="stylesheet" href="{{ asset('css/customerDash.css') }}">
    </head>
    <style>
        .small-calendar {
            width: 70%; /* Adjust width as needed */
            height: 500px; /* Set a fixed height or adjust dynamically */
            margin: 0 auto; /* Center it horizontally */
            border: 1px solid #ccc; /* Optional: Add a border for clarity */
            padding: 10px; /* Add some padding */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow for aesthetics */
            overflow: hidden; /* Ensure content fits inside the container */
            background-color: #f9f9f9; /* Optional background color */
        }

        /* Make sure the table container aligns with the smaller size */
        .table-container {
            text-align: center;
            height: 500px;
        }
        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff; /* Text color */
            background-color: #007bff; /* Button background */
            text-decoration: none; /* Remove underline */
            border-radius: 5px; /* Rounded corners */
            font-weight: bold; /* Bold text */
            text-align: center;
            transition: background-color 0.3s ease; /* Smooth hover effect */
            margin-bottom:3vh;
        }

        .custom-button:hover {
            background-color: #0056b3; /* Darker shade on hover */
            text-decoration: none; /* Prevent underline on hover */
        }
        .fc-daygrid-day-frame {
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Aligns content to the left */
            height: 100%; /* Ensures alignment spans the full height */
            padding-left: 10px; /* Optional: Adds spacing from the edge */
        }

        /* Optional: Customize padding or appearance */
        .fc-daygrid-day-frame {
            font-weight: bold; /* Optional: Makes the day numbers more visible */
        }
        .fc-event-title {
            
            color: white !important; /* Make text white for better contrast on blue */
        }
        
        /* Add hover effect */
        .fc-event {
            background-color: darkblue !important; /* Darker shade on hover */
            color: white
        }
        .fc-event:hover {
            background-color: blue !important; /* Darker shade on hover */
            color: white
        }

    </style>
    <body>
        @include('customerSidebar')
    <div class="content">
        <div class="header">
    <h1>
    WELCOME, 
        @if($userType == 'customer')
            <p>Customer {{ $customer->first_name }} {{ $customer->last_name }}!</p>
        
    </h1>
       </div>
       <br>
       <a href="{{ route('consultation.create') }}" class="custom-button"><b>Add Consultation</b></a>
       <br>

       

       <div class="table-container">
       <div id="calendar" class="small-calendar"><!--main calendar-->
       </div>
      
       
        </div>
        @endif
</body>
<script>/*
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
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

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            @foreach($appointments as $consultation)
                {
                    title: '{{ $consultation->first_name ?? 'Unknown' }} {{ $consultation->last_name ?? '' }}', // Display first and last name
                    start: '{{ $consultation->start }}', // Full datetime (combined date + time)
                    extendedProps: {
                        customer_name: '{{ $consultation->first_name ?? 'Unknown' }} {{ $consultation->last_name ?? '' }}',
                        time: '{{ $consultation->formatted_time }}', // Formatted time (HH:mm)
                        notes: '{{ $consultation->notes ?? 'No notes provided' }}' // Notes or default message
                    },
                    color: 'blue' // Set the highlight color of this event
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
        },
        eventClick: function(info) {
            // Action when an event is clicked
            let eventDetails = `
                Customer Name: ${info.event.extendedProps.customer_name}
                Time: ${info.event.extendedProps.time}
                Date: ${info.event.start.toISOString().split('T')[0]}
                Notes: ${info.event.extendedProps.notes}
            `;
            alert('Event Details:\n' + eventDetails);
        }
    });

    calendar.render();
});

</script>

</html>

