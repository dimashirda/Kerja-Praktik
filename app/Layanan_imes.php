<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan_imes extends Model
{
    protected $primaryKey = 'id_imes';
    public $incrementing = true;
    protected $fillable = [
    'id_imes', 'nama_imes', 'flag'
    ];
    
	public function imes_daftar(){
    	return $this->hasMany('App\Daftar_sid', 'id_imes');
    }
}
