<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;

class UpdateCustomerCalories extends Command
{
    protected $signature = 'update:customer-calories';
    protected $description = 'Update daily_calorie column for all customers';

    public function handle()
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {
            $customer->daily_calorie = $customer->calculateTDEE();
            $customer->save();
        }

        $this->info("✅ All customers' daily_calorie values have been updated!");
    }
}

