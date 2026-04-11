<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerDash.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">
    
    <style>
        .small-calendar {
    width: 100%;
    height: auto; /* Adjusts height dynamically */
    min-height: 600px; /* Ensures enough height for full month view */
    max-height: 800px; /* Prevents it from getting too large */
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    overflow: visible; /* Ensures full visibility */
    background-color: #f9f9f9;
}

/* ✅ Ensures month view displays fully */
.fc-daygrid-body {
    height: 100%;
}

/* ✅ Fixes FullCalendar Event Visibility */
.fc-daygrid-day-frame {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Aligns date numbers to the top-left */
    justify-content: flex-start; /* Aligns date numbers at the top */
    height: 100%;
    padding: 5px; /* Adds spacing */
}

/* ✅ Styles for the date numbers (positions them properly) */
.fc-daygrid-day-top {
    font-weight: bold;
    text-align: left;
    padding-left: 5px; /* Aligns numbers to the left */
    font-size: 14px; /* Adjust size for better readability */
}

/* ✅ Ensures events are fully visible and centered inside the cell */
.fc-event {
    font-size: 14px;
    padding: 5px;
    border-radius: 1px;
    text-align: center;
    background-color: #52634F !important;
    color: white !important;
    width: 100%; /* Ensures the event fills the cell width */
    margin-top: 5px; /* Adds spacing from the date number */
}

/* ✅ Hover effect for better user experience */
.fc-event:hover {
    background-color: #0056b3 !important;
    cursor: pointer;
}

/* ✅ Adjusts calendar row heights dynamically */
.fc-daygrid-day {
    min-height: 100px; /* Prevents overlapping */
}

/* ✅ Responsive Design */
@media (max-width: 768px) {
    .small-calendar {
        min-height: 500px;
        padding: 5px;
    }

    .fc-daygrid-day {
        min-height: 80px;
    }

    .fc-event {
        font-size: 12px;
        padding: 3px;
    }
}

    </style>
</head>
<body>
    @include('customerSidebar')

    <div class="content">
        <div class="header">
            <h1>
                WELCOME, 
                @if($userType == 'customer')
                    <p>Customer {{ $customer->first_name }} {{ $customer->last_name }}!</p>
                @endif
            </h1>
        </div>

        <div class="table-container">
            <div id="calendar" class="small-calendar"></div>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'title',
            right: 'dayGridMonth addConsultationButton'
        },
        customButtons: {
            addConsultationButton: {
                text: 'Add Consultation',
                click: function() {
                    window.location.href = "{{ route('consultation.create') }}";
                }
            }
        },
        events: [
            @foreach($appointments as $consultation)
                {
                    title: formatTime12Hour('{{ $consultation->formatted_time }}'), // Show only formatted time
                    start: '{{ $consultation->start }}', // Keep for correct event placement
                    display: 'block',
                    allDay: false,
                    extendedProps: {
                        time: '{{ $consultation->formatted_time }}',
                        notes: '{{ $consultation->notes ?? 'No notes provided' }}'
                    },
                    color: 'blue'
                }@if(!$loop->last),@endif
            @endforeach
        ],

        // ✅ Ensures only formatted time is displayed
        eventContent: function(arg) {
            let timeLabel = document.createElement('div');
            timeLabel.innerHTML = `<b>${arg.event.title}</b>`; 
            return { domNodes: [timeLabel] };
        },

        // ✅ Shows event details in a modal when clicked
        eventClick: function(info) {
            let eventDetails = '';

            if (info.event.extendedProps.time) {
                eventDetails += `<p><strong>Time:</strong> ${formatTime12Hour(info.event.extendedProps.time)}</p>`;
            }

            if (info.event.start) {
                eventDetails += `<p><strong>Date:</strong> ${info.event.start.toISOString().split('T')[0]}</p>`;
            }

            if (info.event.extendedProps.notes) {
                eventDetails += `<p><strong>Notes:</strong> ${info.event.extendedProps.notes}</p>`;
            }

            if (eventDetails) {
                showModal('Event Details', eventDetails);
            } else {
                showModal('Event Details', '<p>No details available for this event.</p>');
            }
        }
    });

    calendar.render();
});
        function formatTime12Hour(timeString) {
    if (!timeString) return "No time provided";
    let [hours, minutes] = timeString.split(':');
    let ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert 0-23 to 12-hour format
    return `${hours}:${minutes} ${ampm}`;
}


        function showModal(title, content) {
            let modal = document.createElement('div');
            modal.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center; z-index: 1000;">
                    <div style="background: white; padding: 20px; border-radius: 10px; width: 400px;">
                        <h3>${title}</h3>
                        ${content}
                        <button onclick="this.parentElement.parentElement.remove()" style="background: #007bff; color: white; border: none; padding: 10px 20px; cursor: pointer; margin-top: 10px; border-radius: 5px;">Close</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }
    </script>
</body>
</html>
