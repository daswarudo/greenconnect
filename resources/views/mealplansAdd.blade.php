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
    <form class="right-panel" action="{{ route('mealplans.addition') }}" method="POST"><!--form-->
    @csrf
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
                        <select id="subscription_type_id" name="subscription_type_id" style="width: 25vh;" required>
                            <option value="">Select Diet Program</option>
                            @foreach ($subscriptionTypes as $subscriptionType)
                                <option value="{{ $subscriptionType->subscription_type_id }}">
                                    {{ $subscriptionType->plan_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                
                    <label for="meal_name"><b>Meal Name</b></label>
                    <div class="form-group">
                        <input id="meal_name" name="meal_name" type="text" style="width: 45vh;" required />
                    </div>
                
                    <label for="calories"><b>Calories</b></label>
                    <div class="form-group">
                        <input id="calories" name="calories" type="number" step="0.01" style="width: 10vh;" required />
                    </div>
                </div>
                <label for="description"><br><b>Description</b></label>
                <div class="form-group">
                    
                    <!--<input id="description" name="description" type="text" required />-->
                    <textarea name="description" class="form-control" rows="4" style="height:20vh;width: 75vw;"  max="747" required></textarea>
                </div>
                

                <label for="meal_type"><br>
                    <div class="flex">
                    <b>Meal Type</b></label>
                    <div class="radio-group">
                            <input id="breakfast" name="meal_type" type="radio" value="breakfast" required />
                            <label for="breakfast">breakfast</label>
                            <input id="lunch" name="meal_type" type="radio" value="lunch" required />
                            <label for="lunch">lunch</label>
                            <input id="dinner" name="meal_type" type="radio" value="dinner" required />
                            <label for="dinner">dinner</label>
                            <input id="snacks" name="meal_type" type="radio" value="snacks" required />
                            <label for="snacks">snacks</label>
                    </div>
                    </div>
                
                
                <!-- Date Input -->
                <div class="flex">
                <div class="form-group">
                    <label for="date"><br><b>Date</b></label>
                    <input name="date" id="date" class="form-control" style="width: 20vw;"  type="date">
                </div>

                <!-- Time Input
                <div class="form-group">
                    <label for="time"><br><b>Time</b></label>
                    <input name="time" id="time" class="form-control" style="width: 20vw;" type="time" value="00:00">
                </div> -->

            </div>

                <label for="description"><br><b>Allergens</b></label>
                <br>
                <div class="allergens">
                <label>
                
        <input type="checkbox" name="allergy_wheat" value="1" {{ old('allergy_wheat') ? 'checked' : '' }}>
        Wheat
                 </label>
    
    <label>
        <input type="checkbox" name="allergy_milk" value="1" {{ old('allergy_milk') ? 'checked' : '' }}>
        Milk
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_egg" value="1" {{ old('allergy_egg') ? 'checked' : '' }}>
        Egg
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_peanut" value="1" {{ old('allergy_peanut') ? 'checked' : '' }}>
        Peanut
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_fish" value="1" {{ old('allergy_fish') ? 'checked' : '' }}>
        Fish
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_soy" value="1" {{ old('allergy_soy') ? 'checked' : '' }}>
        Soy
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_shellfish" value="1" {{ old('allergy_shellfish') ? 'checked' : '' }}>
        Shellfish
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_treenut" value="1" {{ old('allergy_treenut') ? 'checked' : '' }}>
        Tree Nut
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_sesame" value="1" {{ old('allergy_sesame') ? 'checked' : '' }}>
        Sesame
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_corn" value="1" {{ old('allergy_corn') ? 'checked' : '' }}>
        Corn
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_chicken" value="1" {{ old('allergy_chicken') ? 'checked' : '' }}>
        Chicken
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_beef" value="1" {{ old('allergy_beef') ? 'checked' : '' }}>
        Beef
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_pork" value="1" {{ old('allergy_pork') ? 'checked' : '' }}>
        Pork
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_lamb" value="1" {{ old('allergy_lamb') ? 'checked' : '' }}>
        Lamb
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_gluten" value="1" {{ old('allergy_gluten') ? 'checked' : '' }}>
        Gluten
    </label><br>
            
            </div>
            </div>
            
            
    </div>
    <button class="crudButtons" style="height:5vh;width:15vh;margin-top:2vh;margin-bottom:2vh;"  onclick="return confirm('Are you sure about that?')">Add Meal</button>
    </form> 
</div>
</form> 
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