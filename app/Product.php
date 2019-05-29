<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KategoriProduk;
use App\DetailProduct;

class Product extends Model
{
    protected $table = 'ct_produk';
    protected $guarded = [];
    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo('App\KategoriProduk', 'id_kategori_produk');
    }

    public function detail()
    {
        return $this->hasMany('App\DetailProduct', 'id_produk');
    }
}
