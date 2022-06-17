<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//         $schedule->command('inspire')->hourly();
        $schedule->command('export:order')->dailyAt('21:00');
        $schedule->command('import:all')->dailyAt('23:00');
        $schedule->command('generate:report')->dailyAt('23:10');
        $schedule->command('plan:init')->dailyAt('23:15');
        $schedule->command('plan:calk')->dailyAt('23:20');

        $schedule->command('telescope:clear')->dailyAt('03:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}