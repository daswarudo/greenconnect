<!--






scrapped






-->
<html>
 <head>
  <title>
   Meal Planner
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/mealInput.css') }}">
  
    
 </head>
 <body>
 @include('sidebar')
  <!--<div class="container">
     <div class="sidebar">
    <img alt="Placeholder image" height="100" src="" width="100"/>
    <a href="#">
     <i class="fas fa-users">
     </i>
     Subscribers
    </a>
    <a href="#">
     <i class="fas fa-calendar-alt">
     </i>
     Appointments
    </a>
    <a href="#">
     <i class="fas fa-utensils">  
     </i>
     Meal Plans
    </a>
    <a href="#">
     <i class="fas fa-sign-out-alt">
     </i>
     Log Out
    </a>
   </div>
-->
   <div class="main-content">
    <h1>
     WELCOME, RDN
    </h1>
    <div class="content">
    <h2>
     Restaurant Meal Information
    </h2>
    <label for="meal-name">
     Meal Name:
    </label>
    <input id="meal-name" name="meal-name" type="text"/>
    <label for="protein">
     Protein (g):
    </label>
    <input id="protein" name="protein" type="text"/>
    <label for="carbs">
     Carbs (g):
    </label>
    <input id="carbs" name="carbs" type="text"/>
    <label for="calories">
     Calories:
    </label>
    <input id="calories" name="calories" type="text"/>
    <label for="subscription-type">
     Subscription Type:
    </label>
    <select id="subscription-type" name="subscription-type">
     <option>
      Select Subscription Type
     </option>
    </select>
    <div class="checkbox-group">
     <label>
      Allergies:
     </label>
     <div>
      <input id="wheat" name="allergies" type="checkbox" value="Wheat"/>
      <label for="wheat">
       Wheat
      </label>
     </div>
     <div>
      <input id="milk" name="allergies" type="checkbox" value="Milk"/>
      <label for="milk">
       Milk
      </label>
     </div>
     <div>
      <input id="egg" name="allergies" type="checkbox" value="Egg"/>
      <label for="egg">
       Egg
      </label>
     </div>
     <div>
      <input id="peanut" name="allergies" type="checkbox" value="Peanut"/>
      <label for="peanut">
       Peanut
      </label>
     </div>
     <div>
      <input id="soy" name="allergies" type="checkbox" value="Soy"/>
      <label for="soy">
       Soy
      </label>
     </div>
     <div>
      <input id="fish" name="allergies" type="checkbox" value="Fish"/>
      <label for="fish">
       Fish
      </label>
     </div>
     <div>
      <input id="shellfish" name="allergies" type="checkbox" value="Shellfish"/>
      <label for="shellfish">
       Shellfish
      </label>
     </div>
     <div>
      <input id="tree-nuts" name="allergies" type="checkbox" value="Tree Nuts"/>
      <label for="tree-nuts">
       Tree Nuts
      </label>
     </div>
     <div>
      <input id="sesame" name="allergies" type="checkbox" value="Sesame"/>
      <label for="sesame">
       Sesame
      </label>
     </div>
     <div>
      <input id="corn" name="allergies" type="checkbox" value="Corn"/>
      <label for="corn">
       Corn
      </label>
     </div>
     <div>
      <input id="chicken" name="allergies" type="checkbox" value="Chicken"/>
      <label for="chicken">
       Chicken
      </label>
     </div>
     <div>
      <input id="beef" name="allergies" type="checkbox" value="Beef"/>
      <label for="beef">
       Beef
      </label>
     </div>
     <div>
      <input id="pork" name="allergies" type="checkbox" value="Pork"/>
      <label for="pork">
       Pork
      </label>
     </div>
     <div>
      <input id="lamb" name="allergies" type="checkbox" value="Lamb"/>
      <label for="lamb">
       Lamb
      </label>
     </div>
     <div>
      <input id="gluten" name="allergies" type="checkbox" value="Gluten"/>
      <label for="gluten">
       Gluten
      </label>
     </div>
    </div>
    <button type="submit">
     Submit
    </button>
   </div>
  </div>
 </body>
</html>