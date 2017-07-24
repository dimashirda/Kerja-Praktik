<?php
/**
 * Created by PhpStorm.
 * User: Sabila
 * Date: 7/24/2017
 * Time: 9:41 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Pelanggan;
use DB;

class SearchController
{
    public function pelanggan(){
        $query = Input::get('q');
        $result = DB::table('pelanggans')
            ->where('nama_pelanggan','like','%'.$query.'%')
            ->orderBy('nama_pelanggan')
            ->get();
        return json_encode($result);

    }
}