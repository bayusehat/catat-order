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
        $data = "Assalamualaikum Ukhty";
        $pdf = PDF::loadView('testPdf',compact('data'));
        $pdf->setPaper('a4','portrait');
        return $pdf->stream($data.' - '.date('Y-m-d H:i:s'));

    }
}
