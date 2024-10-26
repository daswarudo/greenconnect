<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionType; // Add this line to import the model

class SubscriptionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $subscriptionTypes = [
            ['plan_name' => 'Weight Loss', 'description' => 'Plan for weight loss', 'price' => 1000.00, 'isAvailable_consult' => true],
            ['plan_name' => 'Weight Gain', 'description' => 'Plan for weight gain', 'price' => 1200.00, 'isAvailable_consult' => true],
            ['plan_name' => 'Gluten-Free', 'description' => 'Special gluten-free diet plan', 'price' => 3000.00, 'isAvailable_consult' => false],
            ['plan_name' => 'Therapeutic', 'description' => 'Special therapeutic diet plan', 'price' => 3500.00, 'isAvailable_consult' => true],
        ];

        foreach ($subscriptionTypes as $type) {
            SubscriptionType::create($type);
        }
    }
}
