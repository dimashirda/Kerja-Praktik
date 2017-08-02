<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Notifikasi;
use DB;

class NotifDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $name = 'notif:daily';
    public function __construct()
    {
        parent::__construct();
    }
    public function notif()
    {
            $datenow = date('Y-m-d');
            $date = date('Y-m-d', strtotime("+30 days"));
            $query = DB::table('Detil_kontraks')
                    ->select('*')
                    ->where('tgl_selesai','<=',$date)
                    ->get();
            foreach ($query as $tmp) {
                $notif = new Notifikasi;
                $notif->id_detil = $tmp->id_detil;
                $notif->flag = '0';
                $notif->save();
            }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
