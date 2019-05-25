<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pesan;

class DetailPesan extends Model
{
    protected $table = 'ct_detail_penjualan';
    protected $guarded = [];
    public $timestamps = false;


    public function pesan()
    {
        return $this->belongsTo('App\Pesan','id_penjualan');
    }
}
