<?php

namespace App\Console;

use App\Console\Commands\DeleteExpiredActivations;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     */
    protected $commands = [
        DeleteExpiredActivations::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('activations:clean')->daily();
        $schedule->command('foods:detach')->dailyAt('06:00'); // this is supposed to work everyday at 6am but for some reason the scheduling doesn't work. the command itself does though so i dont know.
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
