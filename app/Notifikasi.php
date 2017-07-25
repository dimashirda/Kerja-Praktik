<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $primaryKey = 'id_notifikasi';
    public $incrementing = true;

    protected $fillable = [
    'id_notifikasi', 'id_detil', 'flag'
    ];

    public function notifikasi_detil(){
    	return $this->belongsTo('App\Detil_kontrak', 'id_detil');
    }
}
