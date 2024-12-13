<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'feedback';

    // Primary key
    protected $primaryKey = 'feedback_id';

    // Allow mass assignment for these columns
    protected $fillable = [
        'feedback',
        'customer_id',
    ];

    /**
     * Define a relationship to the Customer model
     */
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

}
