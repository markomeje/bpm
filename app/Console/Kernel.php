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
        Commands\PrefixCommand::class,
        Commands\ExpiryCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (config('app.env') !== 'production') {
            $schedule->command('cache:clear')->everyMinute();
            $schedule->command('config:clear')->everyMinute();
            $schedule->command('view:clear')->everyMinute();
            $schedule->command('route:clear')->everyMinute();
            $schedule->command('route:clear')->everyMinute();
        }

        $schedule->command('expiry:check')->everyMinute();
            
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
