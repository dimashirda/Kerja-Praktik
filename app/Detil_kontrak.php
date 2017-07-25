<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detil_kontrak extends Model
{
    protected $primaryKey = 'id_detil';
    public $incrementing = true;

    protected $fillable = [
    'id_detil', 'id_am', 'nipnas', 'id_perusahaan', 'tgl_mulai', 
    'tgl_selesai', 'slg', 'nama_dokumen'
    ];

    public function detil_pelanggan(){
    	return $this->belongsTo('App\Pelanggan', 'nipnas');
    }

    public function detil_perusahaan(){
    	return $this->belongsTo('App\Anak_perusahaan', 'id_perusahaan');
    }

    public function detil_manager(){
    	return $this->belongsTo('App\Account_manager', 'id_am');
    }

    public function detil_kontrak(){
    	return $this->hasMany('App\Layanan_kontrak', 'id_detil');
    }

    public function detil_notifikasi(){
        return $this->hasMany('App\Notifikasi', 'id_detil');
    }
}
