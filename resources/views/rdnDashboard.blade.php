
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect Dashboard</title>

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   ==>login css-->
	<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>

	<script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events',
                selectable: true,
                select: function(info) {
                    var title = prompt('Event Title:');
                    if (title) {
                        axios.post('/events', {
                            title: title,
                            start: info.startStr,
                            end: info.endStr
                        }).then(response => {
                            calendar.addEvent(response.data);
                        });
                    }
                }
            });
            calendar.render();
        });
        
        function searchTable(tableId, inputId) {
    let input = document.getElementById(inputId);
    let filter = input.value.toLowerCase();
    let table = document.getElementById(tableId);
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Skip the header row
        let td = rows[i].getElementsByTagName("td")[0]; // Customer Name column
        if (td) {
            let textValue = td.textContent || td.innerText;
            if (textValue.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}

        function sortTable(n, tableId) {
        var table = document.getElementById(tableId);
        var rows = Array.from(table.rows).slice(1); // Exclude the header row
        var isAscending = table.rows[0].cells[n].getAttribute("data-sort-order") === "asc";
        
        rows.sort(function(a, b) {
            var cellA = a.cells[n].textContent.trim();
            var cellB = b.cells[n].textContent.trim();

            if (cellA < cellB) return isAscending ? -1 : 1;
            if (cellA > cellB) return isAscending ? 1 : -1;
            return 0;
        });

        rows.forEach(function(row) {
            table.appendChild(row);
        });

        // Toggle sorting order
        table.rows[0].cells[n].setAttribute("data-sort-order", isAscending ? "desc" : "asc");
    }
    </script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/rdnDash.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<body>
    @include('sidebar')

  <div class="content">
   <div class="header">
    <h1>
     WELCOME, RDN
    </h1>
    
   </div>
   <div class="dashboard">

   
   <h2>
     GreenConnect Dashboard
    </h2>

    <h3>
     Pending Customers:
    </h3>

     <!--
   -->
<!-- Search Input for Table 1 -->
<input type="text" id="searchInput1" onkeyup="searchTable('subscriptionsTable1', 'searchInput1')" placeholder="Search in Pending Subscriptions..." style="margin-bottom: 10px; padding: 5px;">
<div style="overflow: scroll;height: 30vh;">


<table id="subscriptionsTable1">
    <thead>
        <tr>
            <th onclick="sortTable(0, 'subscriptionsTable1')">Customer Name</th>
            <th onclick="sortTable(1, 'subscriptionsTable1')">Plan Name</th>
            <th onclick="sortTable(2, 'subscriptionsTable1')">Payment Method</th>
            <th onclick="sortTable(3, 'subscriptionsTable1')">Reference Number</th>
            <th onclick="sortTable(4, 'subscriptionsTable1')">Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($subscriptions->where('sub_status', 'pending') as $subscription)
    <tr>
        <td>{{ $subscription->customer->first_name }} {{ $subscription->customer->last_name }}</td>
        <td>{{ $subscription->subscriptionType->plan_name }}</td>
        <td>{{ $subscription->mop ?? 'N/A' }}</td>
        <td>{{ $subscription->ref_number ?? 'N/A' }}</td>
        <td>
            <form action="{{ route('subscriptions.updateStatus') }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Hidden field to pass the customer_id -->
                <input type="hidden" name="customer_id" value="{{ $subscription->customer_id }}">

                <button type="submit" class="crudButtons" style="text-transform: uppercase;">
                    {{ $subscription->sub_status }}
                </button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
   </div>
   <div class="widgets">
    <div class="widget">
     <h3>
      Subscribers
     </h3>
     <p>
      Manage your subscriber list
     </p>
    <!-- Search Input for Table 2 -->
<input type="text" id="searchInput2" onkeyup="searchTable('subscriptionsTable2', 'searchInput2')" placeholder="Search in Active Subscriptions..." style="margin-bottom: 10px; padding: 5px;">
     <div style="overflow: scroll;height: 60vh;">
        
     <table id="subscriptionsTable2">
    <thead>
        <tr>
            <th onclick="sortTable(0, 'subscriptionsTable2')">Name</th>
            <th onclick="sortTable(1, 'subscriptionsTable2')">Subscription</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subscriptions->where('sub_status', 'active') as $subscription)
            <tr>
                <td>{{ $subscription->customer->first_name }} {{ $subscription->customer->last_name }}</td>
                <td>{{ $subscription->subscriptionType->plan_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>


    </div>
    <div class="widget calendar">
     <h3>
      Appointments
     </h3>
     <p>
      View your upcoming appointments
     </p>

	<!--insert calendar-->
	<div id='calendar'></div>
		
    </div>
   </div>
  </div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>