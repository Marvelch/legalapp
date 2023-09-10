<?php

namespace App\Console;

use App\Jobs\SendBulkQueueEmail;
use App\Models\Agreement;
use App\Models\Licensing;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        date_default_timezone_set('Asia/Jakarta');

        $items = Licensing::where('set_notification',date('Y-m-d',strtotime(now())))->get();

        $items_agg = Agreement::where('set_notification',date('Y-m-d',strtotime(now())))->get();

        // $schedule->command('inspire')->hourly();
        $schedule->job(new SendBulkQueueEmail($items, $items_agg), 'QueueEmail')->dailyAt('06:00');
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
