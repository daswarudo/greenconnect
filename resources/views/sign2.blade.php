<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Account and Payment</h2>
    <div class="form-group">
        <label for="username">Username <span> * </span></label>
        <input id="username" name="username" type="text"/ placholder="Desired Username" required />
    </div>
    <div class="form-group">
        <label for="password">Password <span> * </span></label>
        <input id="password" name="password" type="password" placholder="Desired Username" required />
    </div>
    <div class="form-group">
        <label for="payment-option">Payment Option <span> * </span> </label>
        <select id="mode_of_payment" name="mode_of_payment" required >
            <option value="">Select Payment Option</option>
            <option value="GCash">GCash</option>
            <option value="Maya">Maya</option>
            <option value="BPI">BPI</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ref-number">Ref Number <span> * </span> </label>
        <input id="reference_number" name="reference_number" type="text" placeholder="" required />
    </div>
</div>
<div class="form-section allergies">
    <h2>Allergies</h2>
    <div class="checkbox-group">
        <input id="legume" name="allergies" type="checkbox" value="legume"/>
        <label for="legume">Legume</label>    
        <select id="subscription_type_id" name="subscription_type_id" required >
            <option value="">Source</option>
            <option value="1">Weight Loss</option>
            <option value="2">Weight Gain</option>
            <option value="3">Gluten-Free</option>
            <option value="4">Therapeutic</option>
        </select>
    </div>
    <div class="checkbox-group">
        <input id="tree nu" name="allergies" type="checkbox" value="tree nut"/>
        <label for="tree nut">Tree nut</label>
        <select id="subscription_type_id" name="subscription_type_id" required >
            <option value="">Source</option>
            <option value="1">Weight Loss</option>
            <option value="2">Weight Gain</option>
            <option value="3">Gluten-Free</option>
            <option value="4">Therapeutic</option>
        </select>
    </div>
    <div class="checkbox-group">
        <input id="crustecean" name="allergies" type="checkbox" value="crustecean"/>
        <label for="crustecean">Crustecean</label>
        <select id="subscription_type_id" name="subscription_type_id" required >
            <option value="">Source</option>
            <option value="1">Weight Loss</option>
            <option value="2">Weight Gain</option>
            <option value="3">Gluten-Free</option>
            <option value="4">Therapeutic</option>
        </select>
    </div>
    <div class="checkbox-group">
        <input id="mollusk" name="allergies" type="checkbox" value="mollusk"/>
        <label for="mollusk">Mollusk</label>
        <select id="subscription_type_id" name="subscription_type_id" required >
            <option value="">Source</option>
            <option value="1">Weight Loss</option>
            <option value="2">Weight Gain</option>
            <option value="3">Gluten-Free</option>
            <option value="4">Therapeutic</option>
        </select>
    </div>
   
   <!--SUBMIT FORM --><button class="submit-button">Sign Up</button>
</div>
</div>
</form>
</div>
</body>
</body>
</html>