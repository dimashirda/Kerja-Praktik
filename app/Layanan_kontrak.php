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
}
