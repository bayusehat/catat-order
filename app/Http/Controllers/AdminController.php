<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\KategoriProduk;
use App\Pesan;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $all_product = Product::where('deleted','=','0')->count();
        $all_kategori = KategoriProduk::where('deleted','=','0')->count();
        $all_pesanan = Pesan::where('deleted','=','0')->count();
        return view('dashboard',compact('title','all_kategori','all_product','all_pesanan'));
    }
}
