<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod; 

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        $paymentMethods = ['GCash', 'Maya', 'BPI', 'Cash'];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create(['mode_of_payment' => $method]);
        }
    }
}
