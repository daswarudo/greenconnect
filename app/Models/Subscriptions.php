<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional, if the name is not pluralized)
    protected $table = 'subscriptions';

    // Specify the primary key if it's not the default 'id'
    protected $primaryKey = 'subscription_id';

    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'start_date',
        'end_date',
        'subscription_type_id',
    ];

    // Define a relationship with SubscriptionType (assuming you have a SubscriptionType model)
    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id', 'subscription_type_id');
    }

    // Define a relationship with Customer (if a subscription can belong to multiple customers)
    public function customers()
    {
        return $this->hasMany(Customer::class, 'subscription_id', 'subscription_id');
    }
}
