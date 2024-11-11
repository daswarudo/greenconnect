
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers</title>

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   ==>login css-->
	<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>

    <!-- temporary
	<script> 
        

    </script>-->

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/rdnDash.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    

<script>
    function sortTable(columnIndex, tableId) {
    const table = document.getElementById(tableId);
    const tbody = table.tBodies[0]; // Get the tbody element of the table
    const rows = Array.from(tbody.rows); // Convert rows to an array for sorting

    // Determine the current sorting order
    const isAscending = table.getAttribute("data-sort-asc") === "true";
    
    // Sort rows based on the specified column
    rows.sort((a, b) => {
        const cellA = a.cells[columnIndex].textContent.trim();
        const cellB = b.cells[columnIndex].textContent.trim();
        
        // Check if cells contain numbers, otherwise sort as strings
        if (!isNaN(cellA) && !isNaN(cellB)) {
            return isAscending ? cellA - cellB : cellB - cellA;
        } else {
            return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        }
    });

    // Re-attach sorted rows to the tbody
    rows.forEach(row => tbody.appendChild(row));
    
    // Toggle sorting order for the next click
    table.setAttribute("data-sort-asc", !isAscending);
}

    function filterTable(planName) {
    const table = document.getElementById('subscriptionsTable1');
    const rows = Array.from(table.tBodies[0].rows); // Get all rows in the table body

    rows.forEach(row => {
        const rowPlan = row.getAttribute('data-plan'); // Get the plan name from data attribute

        // Show the row if it matches the selected plan, or if "Show All" is clicked
        if (planName === '' || rowPlan === planName) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}
function searchTable() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#subscriptionsTable1 tbody tr'); // Select all rows in the table body

    rows.forEach(row => {
        const firstName = row.cells[0].textContent.toLowerCase(); // First Name column
        const lastName = row.cells[1].textContent.toLowerCase();  // Last Name column
        const planName = row.cells[2].textContent.toLowerCase();  // Subscription Plan column
        const status = row.cells[3].textContent.toLowerCase();    // Status column

        // Check if the search query matches any of the columns (First Name, Last Name, Plan, or Status)
        if (
            firstName.includes(searchQuery) || 
            lastName.includes(searchQuery) || 
            planName.includes(searchQuery) || 
            status.includes(searchQuery)
        ) {
            row.style.display = '';  // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}

// Filter the table by subscription status (active or pending)
function filterByStatus(status) {
    const table = document.getElementById('subscriptionsTable1');
    const rows = Array.from(table.tBodies[0].rows); // Get all rows in the table body

    rows.forEach(row => {
        const rowStatus = row.cells[3].textContent.trim().toLowerCase(); // Get the status from the 4th column (Status)

        // Show the row if it matches the selected status, or if "Show All Status" is clicked
        if (status === '' || rowStatus === status.toLowerCase()) {
            row.style.display = '';  // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}

</script>
</head>
<body>
    @include('sidebar')

    <div class="content">
   <div class="header">
    <h1>
     WELCOME, RDN
    </h1>  
   </div>
   <h3 style = "text-align:center;">
        List of Subscribers
    </h3> 
<div class="tabs">
    <button onclick="filterTable('Weight-Loss Plan')">Weight-Loss Plan</button>
    <button onclick="filterTable('Weight-Gain Plan')">Weight-Gain Plan</button>
    <button onclick="filterTable('Therapeutic Diet')">Therapeutic Diet</button>
    <button onclick="filterTable('Gluten-Free Diet')">Gluten-Free Diet</button>
    <button onclick="filterTable('')">Show All</button> <!-- Optional: Button to show all rows -->
</div>

{{--    this is a comment
<div class="tabs">
    <button onclick="filterByStatus('active')">Active</button>
    <button onclick="filterByStatus('pending')">Pending</button>
    <button onclick="filterByStatus('')">Show All Status</button> <!-- Optional: Show all statuses -->
</div>--}}

<div style = "margin-bottom:1vh">
        <input type="text" id="searchInput" placeholder="Search" onkeyup="searchTable()"  style = "margin-bottom:1vh;height:4vh;"/>
        <button class="crudButtons" style="width:25vh;">Add Customer</button>
</div>

<table class="table" id="subscriptionsTable1" data-sort-asc="true">
    <thead>
        <tr>
            <th onclick="sortTable(0, 'subscriptionsTable1')">First Name</th>
            <th onclick="sortTable(1, 'subscriptionsTable1')">Last Name</th>
            <th onclick="sortTable(2, 'subscriptionsTable1')">Subscription</th>
            <th onclick="sortTable(3, 'subscriptionsTable1')">Status</th>   
        </tr>
    </thead>
    <tbody>
        @foreach($subscriptions as $subscription)
            <tr data-plan="{{ $subscription->subscriptionType->plan_name }}">
                <td>{{ $subscription->customer->first_name }}</td>
                <td>{{ $subscription->customer->last_name }}</td>
                <td>{{ $subscription->subscriptionType->plan_name }}</td>
                <td style="text-transform:uppercase;">{{ $subscription->sub_status }}</td>
                <td>
                    <a href="{{ route('viewsubscriber', $subscription->customer_id) }}" style="text-decoration: none;">
                        <button class="crudButtons">View Details</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>






  </div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
