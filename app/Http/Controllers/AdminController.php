<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\KategoriProduk;
use App\Pesan;
use PDF;

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

    public function test_pdf()
    {   
        $title= "Test Vue";
        return view('testPdf',compact('title'));
    }

    public function kategoriSample()
    {
        $title = 'Data Kategori';
        $kategoris = KategoriProduk::where('deleted','=','0')->orderBy('created','desc')->get();
        return $kategoris;
    }
}
