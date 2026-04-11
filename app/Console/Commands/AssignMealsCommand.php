<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MealController;

class AssignMealsCommand extends Command
{
    protected $signature = 'assign:meals';
    protected $description = 'Assign meals to all customers for the week';

    public function handle()
    {
        $controller = new MealController();
        $controller->assignMealsToCustomers();
        $this->info('Meal assignments completed successfully!');
    }
}

