<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Meals;
use Carbon\Carbon;

class UpdateMealDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meals:update-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update meal dates with a random offset based on the current date';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Loop through all meals and apply your custom logic
        $meals = Meals::all();

        foreach ($meals as $meal) {
            // Seed the random generator with a value that changes daily
            $seed = Carbon::now()->format('Y-m-d') . $meal->meal_id; // Use the date and meal ID as a seed
            srand(crc32($seed));

            // Generate a consistent random offset for the day
            $randomDays = rand(0, 35);

            // Reset the random number generator
            srand();

            // Update the meal's date with the new calculated value
            $meal->date = Carbon::now()->addDays($randomDays)->toDateString();
            $meal->save(); // Save the updated date to the database
        }

        $this->info('Meal dates have been successfully updated.');
    }
}