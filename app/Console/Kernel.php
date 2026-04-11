<?php

namespace App\Console;

use App\Http\Controllers\MealController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use App\Models\Meals;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // This will run the `meals:update-dates` command daily at midnight
        //$schedule->command('meals:update-dates')->daily();
       /* $schedule->command('meals:update-dates')
             ->everyMinute()
             ->appendOutputTo(storage_path('logs/scheduler.log'));*/
           /*  $schedule->call(function () {
                app('App\Http\Controllers\MealController')->assignWeeklyDates();
            })->weeklyOn(1, '00:01');*/
            //$schedule->command('assign:meals')->weeklyOn(1, '00:00');


            $schedule->call(function () {
                \App\Http\Controllers\MealPlanController::resetWeeklyMeals();
            })->weeklyOn(1, '00:00'); // Runs every Monday at midnight
    }

             

    

        protected $commands = [
            \App\Console\Commands\AssignMealsCommand::class,
        ];
        

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        
        require base_path('routes/console.php');
        
    }
}