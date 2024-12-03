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
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Subscription Type</th>
            <th>Meal Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->last_name }}</td>
                <td>{{ $customer->subscription_type }}</td>
                <td>{{ $customer->meal_name }}</td>
                <td>
                    
                    <div class="details" style="display: none;">
                            <b>Customer Daily Calorie: </b>{{ $customer->daily_calorie }} cal <br>
                            <b>Customer Diet Recommended: </b>{{ $customer->diet_recom }}<br>
                            <b>Customer Health Condition: </b>{{ $customer->health_condition }}<br>
                            <b>Customer Activity Level: </b>{{ $customer->activity_level }}<br>
                            
                            <b>Customer Food Preference:</b><br>
                            @if ($customer->prefer_pork)
                                Pork,
                            @else
                            @endif
                            @if ($customer->prefer_beef)
                                Beef,
                            @else
                            @endif
                            @if ($customer->prefer_fish)
                                Fish,
                            @else
                            @endif
                            @if ($customer->prefer_chicken)
                                Chicken,
                            @else
                            @endif
                            @if ($customer->prefer_veggie)
                                Veggie,
                            @else
                            @endif
                            <br>
                            <b>Customer Allergies:</b><br>
                            @if ($customer->customer_allergy_wheat)
                                Wheat,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_milk)
                                Milk,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_egg)
                                Egg,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_peanut)
                                Peanut,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_fish)
                                Fish,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_soy)
                                Soy,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_shellfish)
                                Shellfish,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_treenut)
                                Treenut,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_sesame)
                                Sesame,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_corn)
                                Corn,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_chicken)
                                Chicken,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_beef)
                                Beef,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_pork)
                                Pork,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_lamb)
                                Lamb,
                            @else
                                
                            @endif
                            @if ($customer->customer_allergy_gluten)
                                Gluten
                            @else
                                
                            @endif
                            <br>
                            <b>Meal Calories: </b>{{ $customer->calories }} cal <br>
                            <b>Meal type: </b>{{ $customer->meal_type }}    <br>
                            <b>Meals Allergies:</b><br>
                            @if ($customer->meal_allergy_wheat)
                                Wheat,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_milk)
                                Milk,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_egg)
                                Egg,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_peanut)
                                Peanut,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_fish)
                                Fish,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_soy)
                                Soy,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_shellfish)
                                Shellfish,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_treenut)
                                Treenut,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_sesame)
                                Sesame,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_corn)
                                Corn,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_chicken)
                                Chicken,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_beef)
                                Beef,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_pork)
                                Pork,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_lamb)
                                Lamb,
                            @else
                                
                            @endif
                            @if ($customer->meal_allergy_gluten)
                                Gluten
                            @else
                                
                            @endif
                    </div>
                    <button type="button" class="toggle-details btn btn-sm btn-primary">Show Details</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Add click event to all toggle buttons
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', function () {
                const detailsDiv = this.previousElementSibling;
                const isVisible = detailsDiv.style.display === 'block';

                // Toggle visibility
                detailsDiv.style.display = isVisible ? 'none' : 'block';

                // Update button text
                this.textContent = isVisible ? 'Show Details' : 'Hide Details';
            });
        });
    });
</script>

</html>