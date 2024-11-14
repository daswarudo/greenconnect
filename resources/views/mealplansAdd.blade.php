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
                <label for="diet-program">Diet Program</label>
                <div class="form-group">
                    
                    <select id="subscription_type_id" name="subscription_type_id" required><!-- query subs type-->
                        <option value="">Select Diet Program</option>
                        @foreach ($subscriptionTypes as $subscriptionType)
                            <option value="{{ $subscriptionType->subscription_type_id }}">
                                {{ $subscriptionType->plan_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <label for="meal_name">Meal Name</label>
                <div class="form-group">
                    
                    <input id="meal_name" name="meal_name" type="text" required />
                </div>
                <label for="calories">calories</label>
                <div class="form-group">
                    
                    <input id="calories" name="calories" type="number" step="0.01" required />

                </div>
                <label for="description">description</label>
                <div class="form-group">
                    
                    <input id="description" name="description" type="text" required />
                </div>
                
                <label for="meal_type">Meal Type</label>
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
                
                
                <!-- Date Input -->
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>

                <!-- Time Input -->
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="time" name="time" id="time" class="form-control" required>
                </div>
                
                <label for="description">Allergens</label>
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
        <input type="checkbox" name="allergy_wheat" value="1" {{ old('allergy_wheat') ? 'checked' : '' }}>
        Wheat
    </label><br>
    
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
    <button class="crudButtons" style="height:5vh;width:15vh;margin-top:2vh;">Add Meal</button>
    </form> 
</div>
</form> 
 </body>
</html>