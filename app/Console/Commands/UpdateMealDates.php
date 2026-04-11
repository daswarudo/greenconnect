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
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $startOfWeek = Carbon::now()->startOfWeek(); // Monday of this week

        // Process meals in chunks for efficiency (if you have many meals in the DB)
        Meals::chunk(100, function ($meals) use ($startOfWeek) {
            foreach ($meals as $meal) {
                // Generate a consistent random day within this week (Monday-Sunday)
                $seed = $startOfWeek->format('Y-m-d') . $meal->meal_id; // Combine start of the week and meal ID as a seed
                $randomDays = rand(0, 6); // Generate a random day offset from Monday (0 = Monday, 6 = Sunday)

                // Assign the new date (within this week)
                $meal->date = $startOfWeek->copy()->addDays($randomDays)->toDateString();
                $meal->save(); // Save the updated date to the database
            }
        });

        $this->info('Meal dates have been successfully updated.');
    }
}
