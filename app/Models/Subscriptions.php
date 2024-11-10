<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    // Define the table if the name doesn't follow Laravel's naming convention
    protected $table = 'subscriptions';

    // Define the primary key (if it's not 'id')
    protected $primaryKey = 'subscription_id';

    // If the primary key is not auto-incrementing
    public $incrementing = true;

    // Define the fillable attributes (only the attributes you want to allow mass assignment for)
    protected $fillable = [
        'start_date',
        'end_date',
        'mop', // method of payment
        'ref_number', // reference number
        'subscription_type_id', // foreign key to the subscription_type table
        'customer_id', // foreign key to the customer table
    ];

    // Define the relationships:

    // Each subscription belongs to a subscription type
    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id');
    }

    // Each subscription belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
