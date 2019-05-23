<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'ct_produk';
    protected $guarded = [];
    public $timestamps = false;

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class);
    }
}
