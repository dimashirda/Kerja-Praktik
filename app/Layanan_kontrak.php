<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan_kontrak extends Model
{
    protected $primaryKey = 'id_layanan_kontrak';
    public $incrementing = true;

    protected $fillable = [
    'id_layanan_kontrak', 'id_detil', 'id_layanan'
    ];

    public function kontrak_detil(){
    	return $this->belongsTo('App\Detil_kontrak', 'id_detil');
    }

    public function kontrak_layanan(){
    	return $this->belongsTo('App\Layanan', 'id_layanan');
    }
}
