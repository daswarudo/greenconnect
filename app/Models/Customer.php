<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    public function subscriptions()
    {
        return $this->hasMany(Subscriptions::class, 'customer_id'); // 'customer_id' as foreign key in Subscription
    
    }
    

    public function consultations()
    {
        return $this->hasMany(ConsultationSched::class, 'customer_id');
    }
    public function setProfilePictureAttribute($value)
    {
        $this->attributes['profile_picture'] = 'images/' . $value;
    }
}
