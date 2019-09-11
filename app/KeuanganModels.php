<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeuanganModels extends Model
{
   public $timestamps = false; 
   public $primaryKey = 'id_trans';
   protected $fillable = [
   		'nama',
   		'jenis',
   		'type',
   		'status',
   		'harga',
   		'bayar',
   		'tgl_bayar',
   		'tgl_kridit',
   		'tgl_lunas',
   		'keterangan',
    ];
}
