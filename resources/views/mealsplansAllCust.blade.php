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
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->last_name }}</td>
                <td>{{ $customer->subscription_type }}</td>
                <td>{{ $customer->meal_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{--
                'customer.prefer_pork',
                'customer.prefer_beef',
                'customer.prefer_fish',
                'customer.prefer_chicken',
                'customer.prefer_veggie',

                'customer.allergy_wheat',
                'customer.allergy_milk',
                'customer.allergy_egg',
                'customer.allergy_peanut',
                'customer.allergy_fish',
                'customer.allergy_soy',
                'customer.allergy_shellfish',
                'customer.allergy_treenut',
                'customer.allergy_sesame',
                'customer.allergy_corn',
                'customer.allergy_chicken',
                'customer.allergy_beef',
                'customer.allergy_pork',
                'customer.allergy_lamb',
                'customer.allergy_gluten',--}}
            
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
</script>

</html>