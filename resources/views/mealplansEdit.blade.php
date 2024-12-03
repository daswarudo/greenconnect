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
    <form action="{{ route('meals.update', $meal->meal_id) }}" method="POST">
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
    <h1>View Meal Plans</h1>
    <div class="container">
        
            <div>
                <label for="diet-program"><b>Diet Program</b></label>
                <div class="form-group">
                    
                <select id="subscription_type_id" name="subscription_type_id"  style="width: 50vh;"  required>
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
                <label for="meal_name"><br><b>Meal Name</b></label>
                <div class="form-group">
                    
                    <input id="meal_name" name="meal_name" type="text" value="{{ old('meal_name', $meal->meal_name) }}"  style="width: 50vh;" />
                </div>
                <label for="calories"><br><b>Calories</b></label>
                <div class="form-group">
                    
                    <input id="calories" name="calories" type="number" step="0.01"  value="{{ old('calories', $meal->calories) }}"  style="width: 50vh;"  max="747" />
                    
                </div>
                <label for="description"><br><b>Description</b></label>
                <div class="form-group">
                    <textarea name="description" class="form-control" rows="4"  style="height:30vh;width: 50vh;" >{{ $meal->description }}</textarea>
                    <!--<input id="description" name="description" type="text" value="{{ old('calories', $meal->description) }}" />-->
                </div>
                
                <label for="meal_type"><br><b>Meal Type</b></label>
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

                    
                
                
                <!-- Date Input -->
                <div class="form-group">
                    <label for="date"><br><b>Date</b></label><br>
                    <input name="date" id="date" class="form-control" 
                        value="{{ old('date', $meal->date) }}" style="width: 50vh;"  type="date">
                </div>

                <!-- Time Input -->
                <div class="form-group">
                    <label for="time"><br><b>Time</b></label><br>
                    <input name="time" id="time" class="form-control" 
                        value="{{ old('time', \Carbon\Carbon::parse($meal->time)->format('H:i')) }}"  style="width: 50vh;"  type="time">
                </div>

                
                <label for="description"><br><b>Allergens</b></label>
                
                <br>
                <label>
    <input type="checkbox" name="allergy_wheat" value="1" 
        {{ old('allergy_wheat', $meal->allergy_wheat) ? 'checked' : '' }}>
    Wheat
    </label><br>

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
    <button class="crudButtons" style="height:5vh;width:15vh;margin-top:2vh;"  onclick="return confirm('Are you sure you want to edit this meal?')">Update Meal</button>
    </form> 
    
    <form action="{{ route('meals.destroy', $meal->meal_id) }}" method="POST" style="margin-top: 10px;">
        @csrf
        @method('DELETE')
        <button  class="crudButtons" style="height:5vh;width:15vh;margin-top:2vh;margin-bottom:2vh;" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this meal?')">Delete Meal</button>
    </form> 
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
</script>

</html>