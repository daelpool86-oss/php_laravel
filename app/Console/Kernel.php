<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\SayHello::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {   
        // Run the `say:hello` command every minute. System cron / Task Scheduler
        // should run `php artisan schedule:run` every minute to trigger this.
        $schedule->command('say:hello')->everyMinute();

        // Note: standard cron / Windows Task Scheduler can't reliably run at
        // sub-minute intervals. For every-30s behaviour run the long-lived
        // command (`php artisan say:hello`) under a process manager (Supervisor,
        // NSSM, Windows Service or Task Scheduler Start-Process) so it loops
        // and sleeps every 30 seconds.
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
