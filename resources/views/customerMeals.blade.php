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
// Custom order for meal types
$mealTypeOrder = ['breakfast', 'lunch', 'snacks', 'dinner'];

// Sort meals by meal type based on the custom order
$sortedDetails = $details->sortBy(function ($detail) use ($mealTypeOrder) {
    $mealTypeIndex = array_search(strtolower($detail->meal_type), $mealTypeOrder);
    return $mealTypeIndex !== false ? $mealTypeIndex : count($mealTypeOrder); // Push undefined types to the end
})->sortBy(function ($detail) {
    return \Carbon\Carbon::parse($detail->date)->dayOfWeek; // Then sort by day of the week
});

// Initialize week-based grouping logic
$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$weeks = []; // Array to store meals grouped by week and day

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

// Sort weeks by week number
ksort($weeks);
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
                                                <button class="toggleButton" 
                                                    onclick="showMealDetails({
                                                        mealId: {{ $meal->meal_id }},
                                                        planName: '{{ $meal->plan_name }}',
                                                        description: `{{ $meal->description }}`,
                                                        calories: {{ $meal->calories }},
                                                        mealType: '{{ $meal->meal_type }}',
                                                        date: '{{ $meal->date }}'
                                                    })">
                                                    See More
                                                </button>
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

    <div id="mealModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; border:1px solid #ccc; z-index:1000;">
    <div id="modalContent"></div>
    <button onclick="closeModal()">Close</button>
</div>
<div id="modalBackdrop" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;" onclick="closeModal()"></div>

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
    function showMealDetails(meal) {
        const modalContent = `
            <h3>${meal.planName}</h3>
            <p><strong>Description:</strong> ${meal.description}</p>
            <p><strong>Calories:</strong> ${meal.calories} cal</p>
            <p><strong>Meal Type:</strong> ${meal.mealType}</p>
            <p><strong>Date:</strong> ${meal.date}</p>
        `;
        document.getElementById('modalContent').innerHTML = modalContent;
        document.getElementById('mealModal').style.display = 'block';
        document.getElementById('modalBackdrop').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('mealModal').style.display = 'none';
        document.getElementById('modalBackdrop').style.display = 'none';
    }
</script>
</html>