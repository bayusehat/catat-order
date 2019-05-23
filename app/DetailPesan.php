<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesan extends Model
{
    protected $table = 'ct_detail_penjualan';
    protected $guarded = [];
    public $timestamps = false;


    public function pesan()
    {
        return $this->belongsTo(Pesan::class);
    }
}
