<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
	protected $primaryKey = 'id_layanan';
    public $incrementing = true;

    protected $fillable = [
    'id_layanan', 'nama_layanan', 'deskripsi'
    ];

    public function layanan_kontrak(){
    	return $this->hasMany('App\Layanan_kontrak', 'id_layanan');
    }

}
