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
                <label for="diet-program">Diet Program</label>
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
                <label for="meal_name"><br>Meal Name</label>
                <div class="form-group">
                    
                    <input id="meal_name" name="meal_name" type="text" value="{{ old('meal_name', $meal->meal_name) }}"  style="width: 50vh;" />
                </div>
                <label for="calories"><br>Calories</label>
                <div class="form-group">
                    
                    <input id="calories" name="calories" type="number" step="0.01"  value="{{ old('calories', $meal->calories) }}"  style="width: 50vh;"  max="747" />
                    
                </div>
                <label for="description"><br>Description</label>
                <div class="form-group">
                    <textarea name="description" class="form-control" rows="4"  style="height:30vh;width: 50vh;" >{{ $meal->description }}</textarea>
                    <!--<input id="description" name="description" type="text" value="{{ old('calories', $meal->description) }}" />-->
                </div>
                
                <label for="meal_type"><br>Meal Type</label>
                <div class="radio-group">
                    <input id="breakfast" name="meal_type" type="radio" value="breakfast" 
                        {{ old('meal_type', $meal->meal_type) == 'breakfast' ? 'checked' : '' }} />
                    <label for="breakfast">Breakfast</label>

                    <input id="lunch" name="meal_type" type="radio" value="lunch" 
                        {{ old('meal_type', $meal->meal_type) == 'lunch' ? 'checked' : '' }} />
                    <label for="lunch">Lunch</label>

                    <input id="dinner" name="meal_type" type="radio" value="dinner" 
                        {{ old('meal_type', $meal->meal_type) == 'dinner' ? 'checked' : '' }} />
                    <label for="dinner">Dinner</label>

                    <input id="snacks" name="meal_type" type="radio" value="snacks" 
                        {{ old('meal_type', $meal->meal_type) == 'snacks' ? 'checked' : '' }} />
                    <label for="snacks">Snacks</label>
                </div>

                    
                
                
                <!-- Date Input -->
<div class="form-group">
    <label for="date"><br>Date</label><br>
    <input type="date" name="date" id="date" class="form-control" 
        value="{{ old('date', $meal->date) }}"  style="width: 50vh;" >
</div>

<!-- Time Input -->
<div class="form-group">
    <label for="time"><br>Time</label><br>
    <input type="time" name="time" id="time" class="form-control" 
        value="{{ old('time', \Carbon\Carbon::parse($meal->time)->format('H:i')) }}"  style="width: 50vh;" >
</div>

                
                <label for="description"><br>Allergens</label>
                <!--<div class="form-group">
                    <label for="allergy_wheat">wheat</label>
                    <input id="allergy_wheat" name="allergy_wheat" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_milk">milk</label>
                    <input id="allergy_milk" name="allergy_milk" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_egg">Egg</label>
                    <input id="allergy_egg" name="allergy_egg" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_peanut">Nuts</label>
                    <input id="allergy_peanut" name="allergy_peanut" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_fish">Fish</label>
                    <input id="allergy_fish" name="allergy_fish" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_soy">Soy</label>
                    <input id="allergy_soy" name="allergy_soy" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_shellfish">Shellfish</label>
                    <input id="allergy_shellfish" name="allergy_shellfish" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_treenut">Tree nut</label>
                    <input id="allergy_treenut" name="allergy_treenut" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_sesame">Sesame</label>
                    <input id="allergy_sesame" name="allergy_sesame" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_corn">Corn</label>
                    <input id="allergy_corn" name="allergy_corn" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_chicken">Chicken</label>
                    <input id="allergy_chicken" name="allergy_chicken" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_beef">Beef</label>
                    <input id="allergy_beef" name="allergy_beef" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_pork">Pork</label>
                    <input id="allergy_pork" name="allergy_pork" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_lamb">Lamb</label>
                    <input id="allergy_lamb" name="allergy_lamb" type="checkbox" />
                </div>
                <div class="form-group">
                    <label for="allergy_gluten">Gluten</label>
                    <input id="allergy_gluten" name="allergy_gluten" type="checkbox" />
                </div>-->
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
    <button class="crudButtons" style="height:5vh;width:15vh;margin-top:2vh;"  onclick="return confirm('Are you sure you want to edit this meal?')">Edit Meal</button>
    </form> 
    
    <form action="{{ route('meals.destroy', $meal->meal_id) }}" method="POST" style="margin-top: 10px;">
        @csrf
        @method('DELETE')
        <button  class="crudButtons" style="height:5vh;width:15vh;margin:2vh 0vh 2vh 0vh;" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this meal?')">Delete Meal</button>
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