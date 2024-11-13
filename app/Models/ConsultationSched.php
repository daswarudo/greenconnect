<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationSched extends Model
{
    use HasFactory;

    // Define the table name (optional if it follows Laravel's naming convention)
    protected $table = 'consultation_sched';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'customer_id', 
        'rdn_id', 
        'date', 
        'time'
    ];

    // Define relationships if needed

    // A consultation belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // A consultation belongs to an RDN (assuming RDN is a model)
    public function rdn()
    {
        return $this->belongsTo(Rdn::class, 'rdn_id');
    }
}

