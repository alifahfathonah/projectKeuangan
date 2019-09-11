<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggajianModels extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'tglbayar','keteranggan','jumlah'
    ];
}
