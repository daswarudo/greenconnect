<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // Define the fields that are mass assignable
    protected $fillable = [
        'customer_id',
        'subscription_type_id',
        'start_date',
        'end_date'
    ];

    public function customer()
    {
        // A subscription belongs to a single customer (one-to-one relationship)
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function subscriptionType()
    {
        // A subscription has one specific subscription type
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id', 'subscription_type_id');
    }
}
