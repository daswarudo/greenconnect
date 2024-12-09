<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerFeedback.css') }}">
</head>
<body>
        @include('customerSidebar')
        <div class="content">
   <div class="header">
    <h1>
     Meal Plans
    </h1>
   
   </div>
   <h2>
   
   </h2>
   <div class="feedback-box">
   

    <div style="margin-bottom:2vh;">
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
    </div>

    <div style="overflow: scroll;height: 70vh;margin-top:2vh;">
    <table class="table table-bordered">
        
    </table>
    
    <table>
    <tbody id="tableBody">
    @php
    // Step 1: Sort the details by date
    $sortedDetails = $details->sortBy(function($detail) {
        return \Carbon\Carbon::parse($detail->date)->dayOfWeek;
    });

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $weeks = []; // Array to store meals grouped by week and day

    // Step 2: Group meals by week and day of the week
    foreach ($sortedDetails as $detail) {
        $mealDay = \Carbon\Carbon::parse($detail->date)->format('l'); // Get full day name
        $weekNumber = \Carbon\Carbon::parse($detail->date)->weekOfMonth; // Get the week number of the month

        // Create week entry if it doesn't exist
        if (!isset($weeks[$weekNumber])) {
            $weeks[$weekNumber] = [
                'week' => 'Week ' . $weekNumber,
                'days' => [
                    'Monday' => [],
                    'Tuesday' => [],
                    'Wednesday' => [],
                    'Thursday' => [],
                    'Friday' => [],
                    'Saturday' => [],
                    'Sunday' => []
                ]
            ];
        }

        // Group meals by the corresponding week and day
        $weeks[$weekNumber]['days'][$mealDay][] = $detail;
    }

    // Step 3: Sort the weeks array by week number
    ksort($weeks); // Sorts the weeks by their keys (week numbers) in ascending order
@endphp

@foreach ($weeks as $week)
    <tr class="week-label">
        <td colspan="7">
            <strong>{{ $week['week'] }}</strong><br>
            <button class="toggle-week" onclick="toggleWeek('{{ $week['week'] }}')">Show {{ $week['week'] }}</button>
        </td>
    </tr>

    <tr class="week-contents" id="week-{{ $week['week'] }}" style="display:none;">
        <td colspan="7">
            <table>
                <tr>
                    @foreach ($daysOfWeek as $day)
                        <th>{{ $day }}</th>
                    @endforeach
                </tr>

                <tr>
                    @foreach ($daysOfWeek as $day)
                        <td>
                            @foreach ($week['days'][$day] as $meal)
                                @php
                                $foodNotRecommended = false;
                                @endphp

                                @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                    @if ($meal->{"meal_allergy_{$allergy}"} && $meal->{"customer_allergy_{$allergy}"})
                                        @php
                                            $foodNotRecommended = true;
                                        @endphp
                                        @break
                                    @endif
                                @endforeach

                                @if (!$foodNotRecommended)
                                    <div>
                                        <strong>{{ $meal->meal_name }}</strong><br>
                                        
                                        <button class="toggleButton" data-target="#content{{ $meal->meal_id }}">See More</button>
                                        <div id="content{{ $meal->meal_id }}" style="display: none;">
                                            <span id="moreText">
                                                <em>{{ $meal->plan_name }}</em><br>
                                                <b>Description:</b><br>{{ $meal->description }} <br>
                                                <b>Calories: </b><br>{{ $meal->calories }} cal <br>
                                                <b>Meal type: </b><br>{{ $meal->meal_type }} <br>
                                                <b>Meal date: </b><br>{{ $meal->date }} <br>
                                                <b>Meal time: </b><br>{{ $meal->time }} <br>
                                                <b>Meal Allergies:</b><br>
                                                @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                                    @if ($meal->{"meal_allergy_{$allergy}"})
                                                        {{ ucfirst($allergy) }},
                                                    @endif
                                                @endforeach
                                                <br><b>Customer Allergies:</b><br>
                                                @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                                    @if ($meal->{"customer_allergy_{$allergy}"})
                                                        {{ ucfirst($allergy) }},
                                                    @endif
                                                @endforeach
                                                <br><b>Recommended:</b>
                                                <p>Food Recommended.</p>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            </table>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
    </div>

   </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
    const buttons = document.querySelectorAll('.toggleButton');
    
    document.querySelectorAll('.toggleButton').forEach(button => {
        button.addEventListener('click', () => {
            const target = document.querySelector(button.getAttribute('data-target'));
            if (target.style.display === 'none') {
                target.style.display = 'block';
                button.textContent = 'See Less';
            } else {
                target.style.display = 'none';
                button.textContent = 'See More';
            }
        });
    });
    function toggleWeek(weekName) {
        var weekContent = document.getElementById('week-' + weekName);
        var toggleButton = weekContent.previousElementSibling.querySelector('.toggle-week');

        if (weekContent.style.display === 'none') {
            weekContent.style.display = 'table-row';  // Show the content
            toggleButton.textContent = 'Hide ' + weekName;  // Change button text to 'Hide'
        } else {
            weekContent.style.display = 'none';  // Hide the content
            toggleButton.textContent = 'Show ' + weekName;  // Change button text to 'Show'
        }
    }
</script>
</html>