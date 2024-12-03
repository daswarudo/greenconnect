<html>
 <head>
  <title>
   Meal Planner
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/mealplans.css') }}">
    <style>
        td, th {
            height: 3vh;
            max-height: 3vh;
        }

    </style>
    
 </head>
 <body>
 @include('sidebar')
  <!-- testing 123a
-->

<div class="content">
    <h1>Customer Meal Plans</h1>
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
    <div class="container" style="overflow: scroll;height: 70vh;margin-top:2vh;">
    

    <table class="table table-striped">
    <tbody>
        @php
            // Determine the earliest date to establish "Week 1"
            $earliestDate = $customers->min('date');
            $startOfWeek = \Carbon\Carbon::parse($earliestDate)->startOfWeek();

            // Group customers by relative week (starting from the first detected week)
            $groupedByWeek = $customers->groupBy(function ($customer) use ($startOfWeek) {
                $currentDate = \Carbon\Carbon::parse($customer->date);
                return $startOfWeek->diffInWeeks($currentDate) + 1; // Calculate relative week number
            });

            // Sort weeks numerically
            $sortedWeeks = $groupedByWeek->sortKeys();
        @endphp

        @foreach($sortedWeeks as $weekNumber => $customersInWeek)
            <tr>
                <td colspan="6" style="font-weight: bold; text-align: center; background-color: #e0e0e0;">
                    Week {{ $weekNumber }}
                    <button type="button" class="toggle-week btn btn-sm btn-link" data-target="week-{{ $weekNumber }}">
                        Show Days
                    </button>
                </td>
            </tr>

            @php
                // Further group customers in the week by weekday
                $groupedByDay = $customersInWeek->groupBy(function ($customer) {
                    return \Carbon\Carbon::parse($customer->date)->format('l'); // Full weekday name
                });
            @endphp

            <tr id="week-{{ $weekNumber }}" class="week-container" style="display: none;">
                <td colspan="6">
                    <table class="table">
                        
                        <tbody>
                            @foreach($groupedByDay as $day => $customersByDay)
                                <tr>
                                    <td colspan="6" style="font-weight: bold; text-align: center; background-color: #f9f9f9;">
                                        {{ $day }}<br>
                                        <button type="button" class="toggle-day btn btn-sm btn-link" data-target="day-{{ $weekNumber }}-{{ $day }}">
                                            Show/Hide
                                        </button>
                                    </td>
                                </tr>
                                <tr class="day-container" id="day-{{ $weekNumber }}-{{ $day }}" style="display: none;">
                                    <td colspan="6">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Subscription Type</th>
                                                    <th>Meal Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customersByDay as $customer)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $customer->first_name }}</td>
                                                        <td>{{ $customer->last_name }}</td>
                                                        <td>{{ $customer->subscription_type }}</td>
                                                        <td>{{ $customer->meal_name }}</td>
                                                        <td>
                                                            <div class="details" style="display: none;">
                                                                <b>Date: </b>{{ $customer->date }}<br>
                                                                <b>Customer Daily Calorie: </b>{{ $customer->daily_calorie }} cal<br>
                                                                <b>Customer Diet Recommended: </b>{{ $customer->diet_recom }}<br>
                                                                <b>Customer Health Condition: </b>{{ $customer->health_condition }}<br>
                                                                <b>Customer Activity Level: </b>{{ $customer->activity_level }}<br>
                                                                <b>Meal Calories: </b>{{ $customer->calories }} cal<br>
                                                                <b>Meal Type: </b>{{ $customer->meal_type }}<br>
                                                                <b>Meal Allergies:</b><br>
                                                                @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                                                    @if ($customer->{"meal_allergy_{$allergy}"})
                                                                        {{ ucfirst($allergy) }},
                                                                    @endif
                                                                @endforeach
                                                                <br><b>Customer Allergies:</b><br>
                                                                @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                                                    @if ($customer->{"customer_allergy_{$allergy}"})
                                                                        {{ ucfirst($allergy) }},
                                                                    @endif
                                                                @endforeach
                                                                <br><b>Recommended:</b>
                                                                @php
                                                                $foodNotRecommended = false;
                                                                @endphp

                                                                @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                                                    @if ($customer->{"meal_allergy_{$allergy}"} && $customer->{"customer_allergy_{$allergy}"})
                                                                        @php
                                                                            $foodNotRecommended = true;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach

                                                                @if ($foodNotRecommended)
                                                                    <p>Food Not Recommended: Contains Allergens the Customer is Allergic To.</p>
                                                                @else
                                                                    <p>Food Recommended.</p>
                                                                @endif
                                                            </div>
                                                            <button type="button" class="toggle-details btn btn-sm btn-primary">Show Details</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>







            
    </div>
</div>
    
 </body>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        // Add event listener to toggle the visibility of the week days
        let toggleWeekButtons = document.querySelectorAll('.toggle-week');
        toggleWeekButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                let targetId = button.getAttribute('data-target');
                let weekContainer = document.getElementById(targetId);
                if (weekContainer.style.display === 'none') {
                    weekContainer.style.display = 'table-row'; // Show the days for that week
                    button.textContent = 'Hide Days'; // Change button text to "Hide Days"
                } else {
                    weekContainer.style.display = 'none'; // Hide the days for that week
                    button.textContent = 'Show Days'; // Change button text to "Show Days"
                }
            });
        });

        // Add event listeners to toggle the visibility of each day
        let toggleDayButtons = document.querySelectorAll('.toggle-day');
        toggleDayButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                let targetId = button.getAttribute('data-target');
                let dayRow = document.getElementById(targetId);
                if (dayRow.style.display === 'none') {
                    dayRow.style.display = 'table-row'; // Show the day row
                } else {
                    dayRow.style.display = 'none'; // Hide the day row
                }
            });
        });

        // Add event listeners to toggle the visibility of customer details
        let detailsButtons = document.querySelectorAll('.toggle-details');
        detailsButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                let detailsDiv = button.closest('td').querySelector('.details');
                if (detailsDiv.style.display === 'none') {
                    detailsDiv.style.display = 'block';
                    button.textContent = 'Hide Details';
                } else {
                    detailsDiv.style.display = 'none';
                    button.textContent = 'Show Details';
                }
            });
        });
    });
</script>

</html>