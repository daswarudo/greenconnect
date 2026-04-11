<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Planner</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/mealplans.css') }}">

    <style>
        /* Center the table headers */
        thead th {
            text-align: center;
            vertical-align: middle;
            background-color: #f8f9fa;
            padding: 10px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }
        .close-btn {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }

        /* Ensure meal buttons align properly */
        .meal-container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
            padding: 5px;
        }

        /* Meal Button styling */
        .meal-btn {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 75px;
            font-size: 14px;
            text-align: center;
        }
        .meal-btn:hover {
            background-color: #0056b3;
        }

        /* Assign Meals Button */
        .assign-meals-btn {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .assign-meals-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    @include('sidebar')

    <div class="content">
        <h1>Customer Meal Plans</h1>
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
        
        <div class="container" style="overflow: auto; height: 70vh; margin-top: 2vh;">
            <table border="1">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                       
                        @foreach ($daysOfWeek as $day)
                            <th>{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                            
                        @php
                            $hasMeals = false;
                        @endphp
                
                        @foreach ($daysOfWeek as $day)
                            @php
                                $mealsForDay = $mealPlans[$customer->customer_id][$day] ?? collect();
                                if ($mealsForDay->isNotEmpty()) {
                                    $hasMeals = true;
                                }
                            @endphp
                        @endforeach
                
                        @if ($hasMeals)
                            @foreach ($daysOfWeek as $day)
                                <td>
                                    @php
                                        $mealsForDay = $mealPlans[$customer->customer_id][$day] ?? collect();
                                    @endphp
                
                                    @if ($mealsForDay->isNotEmpty())
                                        @foreach ($mealsForDay as $mealEntry)
                                            <button class="meal-btn" 
                                                data-meal-name="{{ $mealEntry['meal_name'] }}" 
                                                data-meal-type="{{ $mealEntry['meal_type'] }}" 
                                                data-calories="{{ $mealEntry['calories'] }}" 
                                                data-description="{{ $mealEntry['description'] }}">
                                                {{ ucfirst($mealEntry['meal_type']) }}
                                            </button>
                                        @endforeach
                                    @else
                                        <span style="color: gray;">- - -</span>
                                    @endif
                                </td>
                            @endforeach
                        @else
                            <td colspan="{{ count($daysOfWeek) }}" style="text-align: center;">
                                <button class="assign-meals-btn" data-customer-id="{{ $customer->customer_id }}">
                                    Assign Meals
                                </button>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

    <!-- Meal Modal -->
    <div id="meal-modal" class="modal">
        <div class="modal-content">
            <span id="close-btn" class="close-btn">&times;</span>
            <h2 id="meal-title"></h2>
            <p id="meal-details"></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('meal-modal');
            const modalTitle = document.getElementById('meal-title');
            const modalDetails = document.getElementById('meal-details');
            const closeButton = document.getElementById('close-btn');

            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('meal-btn')) {
                    const mealName = event.target.dataset.mealName;
                    const mealType = event.target.dataset.mealType;
                    const calories = event.target.dataset.calories;
                    const description = event.target.dataset.description || "No description available";

                    modalTitle.textContent = `${mealType}: ${mealName}`;
                    modalDetails.innerHTML = `<strong>Calories:</strong> ${calories} kcal <br>
                                              <p><strong>Description:</strong> ${description}</p>`;

                    modal.style.display = "flex";
                }
            });

            closeButton.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            // Assign Meals AJAX
            $(".assign-meals-btn").on("click", function () {
                let customerId = $(this).data("customer-id");

                if (!confirm("Are you sure you want to assign meals to this customer?")) {
                    return;
                }

                $.ajax({
                    url: "{{ route('assignMealsToCustomer') }}",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    data: { customer_id: customerId },
                    success: function (response) {
                        alert("Meals assigned successfully!");
                        location.reload();
                    },
                    error: function (xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            });

        });
    </script>
</body>
</html>
