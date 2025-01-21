<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // This will run the `meals:update-dates` command daily at midnight
        //$schedule->command('meals:update-dates')->daily();
        $schedule->command('meals:update-dates')
             ->everyMinute()
             ->appendOutputTo(storage_path('logs/scheduler.log'));

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        $this->command(UpdateMealDates::class); // This line registers your custom command
        require base_path('routes/console.php');
        
    }
}