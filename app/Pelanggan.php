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

}
