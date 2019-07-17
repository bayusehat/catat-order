<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'ct_pengeluaran';
    protected $guarded = [];
    public $timestamps = false;
    
    public function detailPengeluaran()
    {
        return $this->hasMany('App\DetailPengeluaran', 'id_pengeluaran', 'id_pengeluaran');
    }
}
