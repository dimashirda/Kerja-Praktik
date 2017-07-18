<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak_perusahaan extends Model
{	
    protected $primaryKey = 'id_perusahaan';
    public $incrementing = false;

    protected $fillable = [
    'id_perusahaan', 'nama_perusahaan', 'tlp_perusahaan', 'email_perusahaan'
    ];

      public function perusahaan_detil(){
    	return $this->hasMany('App\Detil_kontrak', 'id_perusahaan');
    }
}
