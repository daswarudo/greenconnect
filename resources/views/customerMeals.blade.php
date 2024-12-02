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
        <thead>
            <tr>
                <th hidden>Meal ID</th>
                <th>Meal Name</th>
                <th>Plan Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($details as $detail)
                <tr>
                    <td hidden>{{ $detail->meal_id }}</td>
                    <td>{{ $detail->meal_name }}</td>
                    <td>{{ $detail->plan_name }}</td>
                    <td>
                    
                    <button class="toggleButton" data-target="#content{{ $detail->meal_id }}">See More</button>
                    <div id="content{{ $detail->meal_id }}" style="display: none;">
                        <span id="moreText">
                            <b>Description:</b>{{ $detail->description }}  <br>
                            <b>Calories: </b>{{ $detail->calories }} cal <br>
                            <b>Meal type: </b>{{ $detail->meal_type }}    <br>
                            <b>Allergies:</b><br>
                            @if ($detail->allergy_wheat)
                                Wheat,
                            @else
                                
                            @endif
                            @if ($detail->allergy_milk)
                                Milk,
                            @else
                                
                            @endif
                            @if ($detail->allergy_egg)
                                Egg,
                            @else
                                
                            @endif
                            @if ($detail->allergy_peanut)
                                Peanut,
                            @else
                                
                            @endif
                            @if ($detail->allergy_fish)
                                Fish,
                            @else
                                
                            @endif
                            @if ($detail->allergy_soy)
                                Soy,
                            @else
                                
                            @endif
                            @if ($detail->allergy_shellfish)
                                Shellfish,
                            @else
                                
                            @endif
                            @if ($detail->allergy_treenut)
                                Treenut,
                            @else
                                
                            @endif
                            @if ($detail->allergy_sesame)
                                Sesame,
                            @else
                                
                            @endif
                            @if ($detail->allergy_corn)
                                Corn,
                            @else
                                
                            @endif
                            @if ($detail->allergy_chicken)
                                Chicken,
                            @else
                                
                            @endif
                            @if ($detail->allergy_beef)
                                Beef,
                            @else
                                
                            @endif
                            @if ($detail->allergy_pork)
                                Pork,
                            @else
                                
                            @endif
                            @if ($detail->allergy_lamb)
                                Lamb,
                            @else
                                
                            @endif
                            @if ($detail->allergy_gluten)
                                Gluten
                            @else
                                
                            @endif
                            
                            </span>
                        </div>
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

</script>
</html>