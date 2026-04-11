<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $guard = 'customer';
    // The table associated with the model.
    protected $table = 'customer';

    // The primary key associated with the table.
    protected $primaryKey = 'customer_id';

    // Indicates if the IDs are auto-incrementing.
    public $incrementing = true;

    // The attributes that are mass assignable.
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'age',
        'sex',
        'weight',
        'height',
        'diet_recom',
        'health_condition',
        'bmi',
        'daily_calorie',
        'activity_level',
        'username',
        'password',
        'profile_picture',
        'prefer_pork',
        'prefer_beef',
        'prefer_fish',
        'prefer_chicken',
        'prefer_veggie',
        'status',
        'contact_num',
        
        'allergy_wheat',
        'allergy_milk',
        'allergy_egg',
        'allergy_peanut',
        'allergy_fish',
        'allergy_soy',
        'allergy_shellfish',
        'allergy_treenut',
        'allergy_sesame',
        'allergy_corn', 'allergy_chicken', 'allergy_beef', 'allergy_pork', 'allergy_lamb', 'allergy_gluten'
    ];




    /*
    <!--basis:
                    $table->boolean('allergy_wheat')->default(false);
                    $table->boolean('allergy_milk')->default(false);
                    $table->boolean('allergy_egg')->default(false);
                    $table->boolean('allergy_peanut')->default(false);
                    $table->boolean('allergy_fish')->default(false);
                    $table->boolean('allergy_soy')->default(false);
                    $table->boolean('allergy_shellfish')->default(false);
                    $table->boolean('allergy_treenut')->default(false);
                    $table->boolean('allergy_sesame')->default(false);
                    $table->boolean('allergy_corn')->default(false);
                            
                    -->
    */
    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'prefer_pork' => 'boolean',
        'prefer_beef' => 'boolean',
        'prefer_fish' => 'boolean',
        'prefer_chicken' => 'boolean',
        'prefer_veggie' => 'boolean',
        'bmi' => 'decimal:2',
        'allergy_wheat' => 'boolean',
        'allergy_milk' => 'boolean',
        'allergy_egg' => 'boolean',
        'allergy_peanut' => 'boolean',
        'allergy_fish' => 'boolean',
        'allergy_soy' => 'boolean',
        'allergy_shellfish' => 'boolean',
        'allergy_treenut' => 'boolean',
        'allergy_sesame' => 'boolean',
        'allergy_corn' => 'boolean',
        'allergy_chicken' => 'boolean',
        'allergy_beef' => 'boolean',
        'allergy_pork' => 'boolean',
        'allergy_lamb' => 'boolean',
        'allergy_gluten' => 'boolean',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'daily_calorie' => 'integer',
        'age' => 'date',
    ];

    // Define the relationship with the Subscription model
    /*public function subscription()
    {
        return $this->hasMany(Subscription::class, 'customer_id');
    }*/
    public function subscriptions() //for history tracking
    {
        return $this->hasMany(Subscriptions::class, 'customer_id'); // 'customer_id' as foreign key in Subscription
    
    }
    

    public function activeSubscription()
{
    return $this->hasOne(Subscriptions::class, 'customer_id')->where('sub_status', 'active');
}


    public function consultations()
    {
        return $this->hasMany(ConsultationSched::class, 'customer_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'customer_id', 'customer_id');
    }

    public function setProfilePictureAttribute($value)
    {
        $this->attributes['profile_picture'] = 'images/' . $value;
    }

    public function meals() {
        return $this->belongsToMany(Meals::class, 'customer_meals', 'customer_id', 'customer_id');
    }

    public function customerMeals()
{
    return $this->hasMany(CustomerMeal::class, 'customer_id','customer_id');
}

public function getCalculatedAgeAttribute()
{
    return Carbon::parse($this->attributes['age'])->age; // Calculates the age
}


public function getAgeAttribute() {
    $birthDate = Carbon::parse($this->attributes['age']);
    $currentDate = Carbon::now();

    // Check if birthday has already happened this year
    $age = $currentDate->year - $birthDate->year;
    if ($currentDate->format('md') < $birthDate->format('md')) {
        $age--;
    }

    return $age;
}



}




