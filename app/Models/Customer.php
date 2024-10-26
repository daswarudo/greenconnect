<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Define the table's primary key, if it’s not 'id'
    protected $primaryKey = 'customer_id';

    // Specify fillable attributes for mass assignment
    protected $fillable = [
        'subscription_type_id',
        'first_name',
        'last_name',
        'sex',
        'age',
        'height',
        'weight',
        'address',
        'contact_num',
        'diet_reco',
        'health_condition',
        'activity_level',
        'username',
        'password',
        'reference_number'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'subscription_id');
    }

    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id', 'subscription_type_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'customer_allergies', 'customer_id', 'allergy_id')
                    ->withPivot('severity', 'reaction')
                    ->withTimestamps();
    }
}
