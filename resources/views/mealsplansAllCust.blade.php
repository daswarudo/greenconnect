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

<div style="overflow-y: scroll; height:70vh;">
<!--
@php
    use Carbon\Carbon;

    // Calculate the start and end of the current week
    $startOfWeek = Carbon::now()->startOfWeek(); // Monday
    $endOfWeek = Carbon::now()->endOfWeek(); // Sunday

    // Filter meals to include only those in the current week
    $groupedMeals = collect($groupedMeals)->filter(function ($days, $week) use ($startOfWeek, $endOfWeek) {
        foreach ($days as $dayName => $meals) {
            foreach ($meals as $meal) {
                $mealDate = Carbon::parse($meal['date']);
                if ($mealDate->between($startOfWeek, $endOfWeek)) {
                    return true;
                }
            }
        }
        return false;
    })->toArray();

    // Sort weeks numerically
    $groupedMeals = collect($groupedMeals)->sortKeysUsing(function ($a, $b) {
        return (int) str_replace('Week ', '', $a) - (int) str_replace('Week ', '', $b);
    })->toArray();

    // Define the order of meal types
    $mealTypeOrder = ['breakfast', 'lunch', 'dinner', 'snacks', 'snack'];
@endphp

@foreach($groupedMeals as $week => $days)
    <div style="margin-bottom: 20px;">
        <h2>{{ $week }}</h2>
        
        <table border="1" style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody>
                @foreach($days as $dayName => $meals)
                    @foreach(collect($meals)->groupBy('customer_id') as $customerId => $customerMeals)
                        @php
                            $firstMeal = collect($customerMeals)->first(); // Get the first meal
                        @endphp
                        <tr>
                            
                            <td>
                                {{ $firstMeal['first_name'] ?? 'Unknown' }} {{ $firstMeal['last_name'] ?? '' }}
                            </td>

                            
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <td>
                                    @php
                                        $mealDate = \Carbon\Carbon::parse($firstMeal['date'])->timezone('UTC'); // Replace 'UTC' with your desired timezone
                                        $mealDayName = $mealDate->format('l'); // Get full weekday name
                                    @endphp

                                    @if($mealDayName === $day)
                                        @foreach(collect($customerMeals)->sortBy(function ($meal) use ($mealTypeOrder) {
                                            return array_search(strtolower($meal['meal_type']), $mealTypeOrder);
                                        }) as $meal)
                                            @php
                                                $foodNotRecommended = false;
                                            @endphp

                                            @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                                @if ($meal["meal_allergy_{$allergy}"] && $meal["customer_allergy_{$allergy}"])
                                                    @php
                                                        $foodNotRecommended = true;
                                                    @endphp
                                                    @break
                                                @endif
                                            @endforeach

                                            @if (!$foodNotRecommended)
                                                <div class="meal-item"
                                                    style="display: block; padding: 10px 20px; margin: 5px 0; background-color: #007bff; color: white; text-align: center; border-radius: 5px; cursor: pointer; font-size: 16px; text-decoration: none; transition: background-color 0.3s, transform 0.2s;"
                                                    onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.05)';"
                                                    onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';"
                                                    onclick="showMealDetails(
                                                        '{{ $meal['meal_name'] ?? 'Unknown Meal' }}', 
                                                        '{{ $meal['description'] ?? 'No description available' }}', 
                                                        '{{ $meal['calories'] ?? '0' }}', 
                                                        '{{ $meal['meal_type'] ?? 'Unknown' }}', 
                                                        '{{ $meal['date'] ?? 'Unknown Date' }}'
                                                    )">
                                                    <strong>{{ ucfirst($meal['meal_type']) }}:</strong> {{ $meal['meal_name'] ?? 'Unnamed Meal' }} ({{ $meal['calories'] ?? '0' }} kcal)
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div>No meals</div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach
                                    
-->

@php
    

    // Calculate the start and end of the current week
    $startOfWeek = Carbon::now()->startOfWeek(); // Monday
    $endOfWeek = Carbon::now()->endOfWeek(); // Sunday

    // Filter meals to include only those in the current week
    $groupedMeals = collect($groupedMeals)->filter(function ($days) use ($startOfWeek, $endOfWeek) {
        foreach ($days as $dayName => $meals) {
            foreach ($meals as $meal) {
                $mealDate = Carbon::parse($meal['date']);
                if ($mealDate->between($startOfWeek, $endOfWeek)) {
                    return true;
                }
            }
        }
        return false;
    })->toArray();

    // Define the order of meal types
    $mealTypeOrder = ['breakfast', 'lunch', 'dinner', 'snacks', 'snack'];
@endphp

<div style="margin-bottom: 20px;">
    <table border="1" style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groupedMeals as $days)
                @foreach($days as $dayName => $meals)
                    @foreach(collect($meals)->groupBy('customer_id') as $customerId => $customerMeals)
                        @php
                            $firstMeal = collect($customerMeals)->first(); // Get the first meal
                        @endphp
                        <tr>
                            <!-- Customer Name -->
                            <td>
                                {{ $firstMeal['first_name'] ?? 'Unknown' }} {{ $firstMeal['last_name'] ?? '' }}
                            </td>

                            <!-- Days of the week -->
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <td>
                                    @php
                                        $mealDate = \Carbon\Carbon::parse($firstMeal['date'])->timezone('UTC'); // Replace 'UTC' with your desired timezone
                                        $mealDayName = $mealDate->format('l'); // Get full weekday name
                                    @endphp

                                    @if($mealDayName === $day)
                                        @foreach(collect($customerMeals)->sortBy(function ($meal) use ($mealTypeOrder) {
                                            return array_search(strtolower($meal['meal_type']), $mealTypeOrder);
                                        }) as $meal)
                                            @php
                                                $foodNotRecommended = false;
                                            @endphp

                                            @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                                @if ($meal["meal_allergy_{$allergy}"] && $meal["customer_allergy_{$allergy}"])
                                                    @php
                                                        $foodNotRecommended = true;
                                                    @endphp
                                                    @break
                                                @endif
                                            @endforeach

                                            @if (!$foodNotRecommended)
                                                <div class="meal-item"
                                                    style="display: block; padding: 10px 20px; margin: 5px 0; background-color: #007bff; color: white; text-align: center; border-radius: 5px; cursor: pointer; font-size: 16px; text-decoration: none; transition: background-color 0.3s, transform 0.2s;"
                                                    onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.05)';"
                                                    onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';"
                                                    onclick="showMealDetails(
                                                        '{{ $meal['meal_name'] ?? 'Unknown Meal' }}', 
                                                        '{{ $meal['description'] ?? 'No description available' }}', 
                                                        '{{ $meal['calories'] ?? '0' }}', 
                                                        '{{ $meal['meal_type'] ?? 'Unknown' }}', 
                                                        '{{ $meal['date'] ?? 'Unknown Date' }}'
                                                    )">
                                                    <strong>{{ ucfirst($meal['meal_type']) }}:</strong> {{ $meal['meal_name'] ?? 'Unnamed Meal' }} ({{ $meal['calories'] ?? '0' }} kcal)
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div>No meals</div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>





    <!--</div>-->

<!-- Popup Modal -->
<div id="mealPopup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; padding: 20px; border-radius: 10px; width: 400px;">
        <h3 id="mealName"></h3>
        <p><strong>Description:</strong> <span id="mealDescription"></span></p>
        <p><strong>Calories:</strong> <span id="mealCalories"></span></p>
        <p><strong>Meal Type:</strong> <span id="mealType"></span></p>
        <p><strong>Date:</strong> <span id="mealDate"></span></p>
        <button onclick="closeMealPopup()">Close</button>
    </div>
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
    // Function to show the meal details in the popup
    function showMealDetails(mealName, mealDescription, mealCalories, mealType, mealDate) {
        document.getElementById('mealName').textContent = mealName;
        document.getElementById('mealDescription').textContent = mealDescription;
        document.getElementById('mealCalories').textContent = mealCalories;
        document.getElementById('mealType').textContent = mealType;
        document.getElementById('mealDate').textContent = mealDate;
        
        // Display the popup
        document.getElementById('mealPopup').style.display = 'flex';
    }

    // Function to close the popup
    function closeMealPopup() {
        document.getElementById('mealPopup').style.display = 'none';
    }
</script>

</html>