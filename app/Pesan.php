<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'ct_penjualan';
    protected $guarded = [];
    public $timestamps = false;

    public function detail()
    {
        return $this->hasMany(DetailPesan::class);
    }
}
