<?php

namespace App\Console;

use DB;
use Notifikasi;
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
        $schedule->call(function(){
            $datenow = date('Y-m-d');
            $date = date('Y-m-d', strtotime("+30 days"));
            $query = DB::table('Detil_kontraks')
                    ->select('*')
                    ->where('tgl_selesai','<=',$date)
                    ->get();
            //$final = array();
            foreach ($query as $tmp) {
                $notif = new Notifikasi;
                $notif->id_detil = $tmp->id_detil;
                $notif->flag = '0';
                $notif->save();
            }
        })->everyMinute();
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
