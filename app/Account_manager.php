<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_manager extends Model
{
    protected $primarykey = 'id_am';
    public $incrementing = false;
    protected $fillable = [
    'id_am','nama_am','tlp_am','email_am'];
}
