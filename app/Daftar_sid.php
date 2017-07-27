<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar_sid extends Model
{
    protected $primaryKey = 'sid';
    public $incrementing = false;

    protected $fillable = [
    'sid', 'id_perusahaan', 'nipnas', 'alamat_sid', 'id_imes'
    ];

    public function daftar_pelanggan(){
    	return $this->belongsTo('App\Pelanggan', 'nipnas');
    }

    public function daftar_perusahaan(){
    	return $this->belongsTo('App\Anak_perusahaan', 'id_perusahaan');
    }

    public function daftar_imes(){
    	return $this->belongsTo('App\Layanan_imes', 'id_imes');
    }
}
