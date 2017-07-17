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
}
