<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Meal Plans</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerFeedback.css') }}">

    <style>
        body {
            overflow-x: hidden;
            font-family: Arial, sans-serif;
        }

        .meal-btn {
            width: 100px;
            height: 50px;
            margin: 5px;
            padding: 10px;
            background-color: #52634F;
            color: white;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }

        .meal-btn:hover {
            background-color: #45a049;
        }

        thead th {
            text-align: center;
            vertical-align: middle;
            background-color: #f8f9fa;
            padding: 10px;
        }

        .meal-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        /* Modal Styles */
        #mealModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        #modalBackdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        #closeModalBtn {
            background-color: #52634F;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        #closeModalBtn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    @include('customerSidebar')

    <div class="content">
        <h1>Meal Plans</h1>

        <div style="overflow: auto; height: 70vh; margin-top: 2vh;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        @php
                            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        @endphp
                        @foreach ($daysOfWeek as $day)
                            <th>{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @php
                            use Carbon\Carbon;
                            $mealTypeOrder = ['Breakfast', 'Lunch', 'Snacks', 'Dinner'];
                        @endphp

                        @foreach ($daysOfWeek as $day)
                            <td>
                                @php
                                    $mealsForDay = $meals[$day] ?? collect();
                                    $sortedMeals = $mealsForDay->sortBy(function ($meal) use ($mealTypeOrder) {
                                        return array_search(ucfirst($meal->meal_type), $mealTypeOrder);
                                    });
                                @endphp

                                @if ($sortedMeals->isNotEmpty())
                                    <div class="meal-container">
                                        @foreach ($sortedMeals as $meal)
                                            <button class="meal-btn"
                                                data-meal-name="{{ $meal->meal->meal_name }}"
                                                data-meal-type="{{ ucfirst($meal->meal_type) }}"
                                                data-calories="{{ $meal->meal->calories }}"
                                                data-description="{{ $meal->meal->description }}"
                                                onclick="showMealDetails(this)">
                                                {{ ucfirst($meal->meal_type) }}
                                            </button>
                                        @endforeach
                                    </div>
                                @else
                                    <span style="color: gray;">- - -</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Meal Modal -->
    <div id="mealModal">
        <div id="modalContent"></div>
        <button id="closeModalBtn" onclick="closeModal()">Close</button>
    </div>
    <div id="modalBackdrop" onclick="closeModal()"></div>

    <script>
        function showMealDetails(button) {
            const meal = {
                mealName: button.dataset.mealName,
                description: button.dataset.description || "No description available",
                calories: button.dataset.calories,
                mealType: button.dataset.mealType
            };

            const modalContent = `
                <h3>${meal.mealName}</h3>
                <p><strong>Type:</strong> ${meal.mealType}</p>
                <p><strong>Calories:</strong> ${meal.calories} kcal</p>
                <p><strong>Description:</strong> ${meal.description}</p>
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
</body>
</html>
