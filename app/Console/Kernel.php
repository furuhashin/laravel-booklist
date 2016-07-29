<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * アプリケーションで提供するArtisanコマンド
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        Commands\SendEmails::class,
    ];

    /**
     * アプリケーションのコマンド実行スケジュール定義
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $filePath = storage_path() ."/logs/cron/SendEmails.txt";

/*        $schedule->command('inspire')->hourly();*/

        $schedule->command('emails:send')
            ->dailyAt('12:00')->appendOutputTo($filePath);
    }
}
