
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
        
        /*function sortTable(n) {
        var table = document.getElementById("subscriptionsTable");
        var rows = Array.from(table.rows).slice(1);
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
        }*/
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
       
        @foreach ($subscriptions->where('customer.status', 'pending') as $subscription)
            <tr>
                <td>{{ $subscription->customer->first_name }} {{ $subscription->customer->last_name }}</td>
                <td>{{ $subscription->subscriptionType->plan_name }}</td>
                <td>{{ $subscription->mop ?? 'N/A' }}</td>
                <td>{{ $subscription->ref_number ?? 'N/A' }}</td>
                <td>
                    <button class = "crudButtons" style="text-transform: uppercase;">
                        {{ $subscription->customer->status }}
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>-->
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
    @foreach ($subscriptions->where('customer.status', 'pending') as $subscription)
    <tr>
        <td>{{ $subscription->customer->first_name }} {{ $subscription->customer->last_name }}</td>
        <td>{{ $subscription->subscriptionType->plan_name }}</td>
        <td>{{ $subscription->mop ?? 'N/A' }}</td>
        <td>{{ $subscription->ref_number ?? 'N/A' }}</td>
        <td>
        <form action="{{ route('subscriptions.updateStatus') }}" method="POST">
    @csrf
    @method('PATCH')

    <!-- Dropdown to select the new status for the customer -->
    <select name="status" class="form-control">
        <option value="pending" {{ $subscription->customer->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ $subscription->customer->status == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="canceled" {{ $subscription->customer->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
    </select>

    <!-- Hidden field to pass the subscription_id -->
    <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

    <button type="submit" class="crudButtons" style="text-transform: uppercase;">
        Edit Status
    </button>
</form>




        </td>
    </tr>
@endforeach

    </tbody>
</table>

   </div>
   <div class="widgets">
    <div class="widget">
     <h3>
      Subscribers
     </h3>
     <p>
      Manage your subscriber list
     </p>


     <table id="subscriptionsTable2">
    <thead>
        <tr>
            <th onclick="sortTable(0, 'subscriptionsTable2')">Name</th>
            <th onclick="sortTable(1, 'subscriptionsTable2')">Subscription</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subscriptions->where('customer.status', 'active') as $subscription)
            <tr>
                <td>{{ $subscription->customer->first_name }} {{ $subscription->customer->last_name }}</td>
                <td>{{ $subscription->subscriptionType->plan_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


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
