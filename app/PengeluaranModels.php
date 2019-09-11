<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengeluaranModels extends Model
{
    public $timestamps = false;
    protected $fillable = [
   		'nama_kpn', 'jumlah', 'total', 'tanggal', 'level'
    ];
}
