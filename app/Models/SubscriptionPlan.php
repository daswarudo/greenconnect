<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'subscription_plan';

    // Specify the primary key if it's not the default 'id'
    protected $primaryKey = 'subscription_plan_id';

    // Disable auto-increment if necessary (since the ID is defined as primary)
    public $incrementing = true;

    // If your primary key is not an integer, set the type
    protected $keyType = 'int';

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'plan_name',
        'description',
        'price',
        'isAvailable_consult',
    ];

    // Optionally, you can add casts for attributes
    protected $casts = [
        'price' => 'decimal:2',
        'isAvailable_consult' => 'boolean',
    ];
}
