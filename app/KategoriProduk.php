<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KategoriProduk extends Model
{
    protected $table='ct_kategori_produk';
    protected $fillable = ['nama_kategori_produk'];
    public $timestamps = false;

    public function getAutocomplete(String $q) {
        return DB::table('ct_kategori_produk AS c')
            ->select(DB::raw('
                c.id_kategori_produk, c.nama_kategori_produk
            '))
            ->where(function($query) use ($q) {
                $query->where('c.nama_kategori_produk', 'like', "%$q%");
            })
            ->get();
    }
}
