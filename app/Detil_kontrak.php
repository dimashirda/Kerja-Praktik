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
}
