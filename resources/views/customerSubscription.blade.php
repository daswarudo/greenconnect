
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerSubscription.css') }}">
</head>
<body>
        @include('customerSidebar')

<div class="content">
   
   <div class="subscription-info" style="margin-top:5vh;">
    <h2>Welcome, {{$customer->first_name}} {{$customer->last_name}}</h2>
    <h2>Subscriptions</h2>
    <div class="mb-3" style="margin-bottom:2vh;">
            <input id="searchInput" type="text" class="form-control" placeholder="Search subscriptions...">
        </div>
<!--
        <div class="table-responsive" style="max-height: 60vh; height:60vh; overflow-y: auto;">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Subscription</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody id="subscriptionTable">
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->plan_name }}</td>
                        <td>{{ $subscription->sub_status }}</td>
                        <td>{{ $subscription->start_date }}</td>
                        <td>{{ $subscription->end_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    <a href="/customerSubscriptionAdd">
        <button type="submit">
            ADD
        </button>
    </a>
--> 
    <div class="table-responsive" style="max-height: 60vh; height:60vh; overflow-y: auto;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Subscription</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody id="subscriptionTable">
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->plan_name }}</td>
                    <td class="sub-status">{{ $subscription->sub_status }}</td>
                    <td>{{ $subscription->start_date }}</td>
                    <td>{{ $subscription->end_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="/customerSubscriptionAdd">
    <button type="submit" id="addButton">
        ADD
    </button>
</a>


  
   </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchInput').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('#subscriptionTable tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
        const addButton = document.getElementById("addButton");
        const statusCells = document.querySelectorAll(".sub-status");

        // Check if any row has "active" status
        const hasActiveStatus = Array.from(statusCells).some(cell => cell.textContent.trim().toLowerCase() === "active");

        // Toggle button based on status
        addButton.disabled = hasActiveStatus;
    });
    </script>
</body>
</html>