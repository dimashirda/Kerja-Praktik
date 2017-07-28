<?php
/**
 * Created by PhpStorm.
 * User: Sabila
 * Date: 7/26/2017
 * Time: 9:19 PM
 */

namespace App\Http\Controllers;
use DB;

class TelkomController
{
    protected $allNotif;
    public function __construct() {
        $this->allNotif = DB::table('Notifikasis')
            ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
            ->get();
    }
    public function struktur() {
        return view ('struktur', ['allNotif'=>$this->allNotif]);
    }
}