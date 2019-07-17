<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPengeluaran extends Model
{
    protected $table = "ct_detail_pengeluaran";
    protected $guarded = [];
    public $timestamps = false;

    public function pengeluaran()
    {
        return $this->belongsTo('App\Pengeluaran', 'id_pengeluaran', 'id_pengeluaran');
    }
}
