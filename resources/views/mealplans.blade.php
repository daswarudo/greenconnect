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
  <!--
-->

<div class="content">
    <h1>Meal Plans</h1>
    <div class="container" style="overflow: scroll;height: 70vh;">
            

            <!-- Table for displaying meals -->
            <table class="table table-bordered" style="height:auto;max-height:80vh;">
                <thead>
                    <tr>
                        <th>Meal Name</th>
                        <th>Description</th>
                        <th>Calories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meals as $meal)
                        <tr>
                            <td>{{ $meal->meal_name }}</td>
                            <td>{{ $meal->description }}</td>
                            <td>{{ number_format($meal->calories, 2) }}</td>

                            <td><button class="crudButtons">View Details</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
    </div>
    <a href="/mealplansAdd" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px; display: inline-block; font-weight: bold; text-align: center; margin-top:3vh;">
        Add Meals
    </a>


</div>
    
 </body>
</html>