<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
	protected $primaryKey = 'nipnas';
    public $incrementing = false;

    protected $fillable = [
    'nipnas', 'nama_pelanggan', 'tlp_pelanggan', 'email_pelanggan'
    ];

    public function pelanggan_detil(){
    	return $this->hasMany('App\Detil_kontrak', 'nipnas');
    }

}
