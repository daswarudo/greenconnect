<html>
 <head>
  <title>
   Meal Planner
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/mealplans.css') }}">
  
    
 </head>
 <body>

 @include('sidebar')


  <!--
-->


<div class="content">
    <form action="{{ route('meals.update', $meal->meal_id) }}" method="POST"><!--form-->
    @csrf
        @method('PUT')
    @if(session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
	@endif
    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                     @endif
    <h1>Meal Plans</h1>
    <div class="container">
        
            <div>
                <div class="flex">
                    <label for="diet-program"><b>Diet Program</b></label>
                    <div class="form-group">
                        <select id="subscription_type_id" name="subscription_type_id"  style="width: 14vw; font-size: 16px;"  required>
                    		<option value="">Select Diet Program</option>
                    		@foreach ($subscriptionTypes as $subscriptionType)
                        	<option value="{{ $subscriptionType->subscription_type_id }}" 
                            @if ($subscriptionType->subscription_type_id == old('subscription_type_id', $meal->subscription_type_id)) 
                                selected 
                            @endif>
                            {{ $subscriptionType->plan_name }}
                        	</option>
                    	@endforeach
                	</select>
                    </div>
                
                    <label for="meal_name"><b>Meal Name</b></label>
                    <div class="form-group">
                        <input id="meal_name" name="meal_name" type="text" value="{{ old('meal_name', $meal->meal_name) }}"  style="width: 20vw; font-size: 16px;" />
                    </div>
                
                    <label for="calories"><b>Calories</b></label>
                    <div class="form-group">
                        <input id="calories" name="calories" type="number" step="0.01"  value="{{ old('calories', $meal->calories) }}"  style="width: 7vw; font-size: 16px;"  max="747" />
                    </div>
                </div>
                <label for="description"><br><b>Description</b></label>
                <div class="form-group">
                    
                    <!--<input id="description" name="description" type="text" required />-->
                    <textarea name="description" class="form-control" rows="4"  style="height:20vh;width: 75vw; font-size: 18px !important;" >{{ $meal->description }}</textarea>
                </div>
                

                <label for="meal_type"><br>
                    <div class="flex">
                    <b>Meal Type</b></label>
                    <div class="radio-group">
                    <input id="meal_type" name="meal_type" type="radio" value="breakfast" 
                        {{ old('meal_type', $meal->meal_type) == 'breakfast' ? 'checked' : '' }} />
                    <label for="breakfast">Breakfast</label>

                    <input id="meal_type" name="meal_type" type="radio" value="lunch" 
                        {{ old('meal_type', $meal->meal_type) == 'lunch' ? 'checked' : '' }} />
                    <label for="lunch">Lunch</label>

                    <input id="meal_type" name="meal_type" type="radio" value="dinner" 
                        {{ old('meal_type', $meal->meal_type) == 'dinner' ? 'checked' : '' }} />
                    <label for="dinner">Dinner</label>

                    <input id="meal_type" name="meal_type" type="radio" value="snacks" 
                        {{ old('meal_type', $meal->meal_type) == 'snacks' ? 'checked' : '' }} />
                    <label for="snacks">Snacks</label>
                </div>
                    
                @php
    use Carbon\Carbon;

    // Get current date
    $today = Carbon::now()->format('Y-m-d');

    // Get the start and end of the current week
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = $startOfWeek->copy()->endOfWeek();

    // Ensure $meal is defined
    if (!isset($meal)) {
        $meal = new stdClass();
        $meal->date = null;
    }

    // Validate meal date
    if (!empty($meal->date) && strtotime($meal->date) !== false) {
        $mealDate = Carbon::parse($meal->date);
        if ($mealDate->between($startOfWeek, $endOfWeek)) {
            $selectedDate = $meal->date; // Keep meal date if it's within the current week
        } else {
            $selectedDate = $today; // Default to today if meal date is out of range
        }
    } else {
        $selectedDate = $today; // Default to today if no meal date exists
    }

    // Ensure $selectedDate is in YYYY-MM-DD format
    $selectedDate = Carbon::parse($selectedDate)->format('Y-m-d');
@endphp




                
                <!-- Date Input -->
                
                    
                <div class="form-group" hidden>
                    <label for="date"><b>Date</b></label>
                    <input name="date" id="date" class="form-control" type="date" value="{{ old('date', $selectedDate) }}">
                </div>

                <!--
                <div class="flex" style="display: none;">
                    <div class="form-group">
                        <label for="date"><br><b>Date</b></label>
                        <input name="date" id="date" class="form-control" style="width: 20vw;" type="date">
                    </div>
                </div>
-->
                <!-- Time Input 
                <div class="form-group">
                    <label for="time"><br><b>Time</b></label>
                    <input name="time" id="time" class="form-control" style="width: 20vw;" type="time" value="00:00">
                </div>-->

            </div>

                <label for="description"><br><b>Allergens</b></label>
                <br>
                <div class="allergens">
                <label>
                
        <input type="checkbox" name="allergy_wheat" value="1" 
        {{ old('allergy_wheat', $meal->allergy_wheat) ? 'checked' : '' }}>
        Wheat
                 </label>
    
    <label>
        <input type="checkbox" name="allergy_milk" value="1" 
            {{ old('allergy_milk', $meal->allergy_milk) ? 'checked' : '' }}>
        Milk
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_egg" value="1" 
            {{ old('allergy_egg', $meal->allergy_egg) ? 'checked' : '' }}>
        Egg
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_peanut" value="1" 
            {{ old('allergy_peanut', $meal->allergy_peanut) ? 'checked' : '' }}>
        Peanut
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_fish" value="1" 
            {{ old('allergy_fish', $meal->allergy_fish) ? 'checked' : '' }}>
        Fish
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_soy" value="1" 
            {{ old('allergy_soy', $meal->allergy_soy) ? 'checked' : '' }}>
        Soy
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_shellfish" value="1" 
            {{ old('allergy_shellfish', $meal->allergy_shellfish) ? 'checked' : '' }}>
        Shellfish
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_treenut" value="1" 
            {{ old('allergy_treenut', $meal->allergy_treenut) ? 'checked' : '' }}>
        Tree Nut
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_sesame" value="1" 
            {{ old('allergy_sesame', $meal->allergy_sesame) ? 'checked' : '' }}>
        Sesame
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_corn" value="1" 
            {{ old('allergy_corn', $meal->allergy_corn) ? 'checked' : '' }}>
        Corn
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_chicken" value="1" 
            {{ old('allergy_chicken', $meal->allergy_chicken) ? 'checked' : '' }}>
        Chicken
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_beef" value="1" 
            {{ old('allergy_beef', $meal->allergy_beef) ? 'checked' : '' }}>
        Beef
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_pork" value="1" 
            {{ old('allergy_pork', $meal->allergy_pork) ? 'checked' : '' }}>
        Pork
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_lamb" value="1" 
            {{ old('allergy_lamb', $meal->allergy_lamb) ? 'checked' : '' }}>
        Lamb
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_gluten" value="1" 
            {{ old('allergy_gluten', $meal->allergy_gluten) ? 'checked' : '' }}>
        Gluten
    </label><br>
            
            </div>
            </div>
            
            
    </div>
    <div style="display: inline-flex; gap: 50px; margin-top:30px;">
        <button class="crudButtons" style="height:8vh;width:15vh;"  onclick="return confirm('Are you sure you want to edit this meal?')">Update Meal</button>
    </form> 
	<form action="{{ route('meals.destroy', $meal->meal_id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button  class="crudButtons" style="height:8vh;width:15vh; " type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this meal?')">Delete Meal</button>
    </form>
    </div>
   
</div>
 
 </body>
 <script>
 document.getElementById('calories').addEventListener('input', function (e) {
        const max = 747;
        const value = parseFloat(e.target.value);

        if (value > max) {
            alert('Calories cannot exceed 747.');
            e.target.value = max; // Reset to max value
        }
    });
    /*
    const startDate = new Date();
    const endDate = new Date();
    endDate.setMonth(endDate.getMonth() + 2);

    const randomTimestamp = startDate.getTime() + Math.random() * (endDate.getTime() - startDate.getTime());
    const randomDate = new Date(randomTimestamp);

    const formattedDate = randomDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD
    document.getElementById('date').value = formattedDate;

    document.getElementById('calories').addEventListener('input', function (e) {
        const max = 747;
        const value = parseFloat(e.target.value);

        if (value > max) {
            alert('Calories cannot exceed 747.');
            e.target.value = max; // Reset to max value
        }
    });*/
</script>
</html>