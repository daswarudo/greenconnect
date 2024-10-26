<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    use HasFactory;

    // If your table name does not follow Laravel's plural convention, specify it here
    protected $table = 'subscription_type';

    // Define the fields that are mass assignable
    protected $fillable = [
        'plan_name',
        'description',
        'price',
        'isAvailable_consult',
    ];

    // Define any relationships if applicable, for example, a relationship to subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscription_type_id');
    }

    // Relationship to customers through the subscription_id in the Customer table
    public function customers()
    {
        return $this->hasMany(Customer::class, 'subscription_type_id');
    }
}
