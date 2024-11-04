<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    // Define the table name if different from the default (lowercase model name)
    protected $table = 'payments';

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'customer_id',
        'subscription_type_id',
        'mode_of_payment',
        'reference_number',
    ];

    /**
     * Define a relationship to the Customer model.
     * Each payment belongs to a customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Define a relationship to the SubscriptionType model.
     * Each payment is associated with a subscription type.
     */
    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id');
    }
}
