<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class DetailProduct extends Model
{
    protected $table = 'ct_detail_produks';
    protected $fillable = ['img_produk','id_produk'];
    public $timestamps = false;


    public function product()
    {
        return $this->belongsTo('App\Product', 'id_produk');
    }
}
