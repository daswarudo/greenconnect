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
        $sortedDetails = $details->sortBy(function($detail) {
            return \Carbon\Carbon::parse($detail->date)->dayOfWeek;
        });

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeks = [];  // Array to store meals grouped by week and day
        $currentWeek = null;

        // Group meals by week and day of the week
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
    @endphp

    @foreach ($weeks as $week)
        <tr class="week-label">
            <td colspan="7"><strong>{{ $week['week'] }}</strong></td>
        </tr>

        <tr>
            @foreach ($daysOfWeek as $day)
                <th>{{ $day }}</th>
            @endforeach
        </tr>

        <tr>
            @foreach ($daysOfWeek as $day)
                <td>
                    @foreach ($week['days'][$day] as $meal)
                        <div>
                            <strong>{{ $meal->meal_name }}</strong><br>
                            <em>{{ $meal->plan_name }}</em><br>
                            <button class="toggleButton" data-target="#content{{ $meal->meal_id }}">See More</button>
                            <div id="content{{ $meal->meal_id }}" style="display: none;">
                                <span id="moreText">
                                    <b>Description:</b>{{ $meal->description }} <br>
                                    <b>Calories: </b>{{ $meal->calories }} cal <br>
                                    <b>Meal type: </b>{{ $meal->meal_type }} <br>
                                    <b>Meal date: </b>{{ $meal->date }} <br>
                                    <b>Meal time: </b>{{ $meal->time }} <br>
                                    <b>Allergies:</b><br>
                                    @foreach (['wheat', 'milk', 'egg', 'peanut', 'fish', 'soy', 'shellfish', 'treenut', 'sesame', 'corn', 'chicken', 'beef', 'pork', 'lamb', 'gluten'] as $allergy)
                                        @if ($meal->{"allergy_{$allergy}"})
                                            {{ ucfirst($allergy) }},
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    @endforeach
                </td>
            @endforeach
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

</script>
</html>