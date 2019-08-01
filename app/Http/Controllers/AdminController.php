<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\KategoriProduk;
use App\Pesan;
use PDF;
use Session;

class AdminController extends Controller
{

    public function index()
    {
        if(session()->get('logged_in') != TRUE){
            return view('login');
        };

        $title = 'Dashboard';
        $all_product = Product::where('deleted','=','0')->count();
        $all_kategori = KategoriProduk::where('deleted','=','0')->count();
        $all_pesanan = Pesan::where('deleted','=','0')->count();
        $sess = print_r(Session::all());
        $chart = $this->chartStats();
            foreach($chart as $data){
                $jumlah[] = $data->m;
                $nama[] = date('F Y',strtotime($data->d));
            }
        return view('dashboard',compact('title','all_kategori','all_product','all_pesanan','jumlah','nama','sess'));
    }

    public function chartStats()
    {
        // $query = $this->db->query("SELECT count(kode_penjualan) as m, DATE_FORMAT(tanggal_penjualan,'%Y-%m')as d FROM ct_penjualan WHERE deleted=0 GROUP BY DATE_FORMAT(tanggal_penjualan,'%Y-%m')");
        $query = DB::table('ct_penjualan')
                    ->select(DB::raw("count(kode_penjualan) as m, DATE_FORMAT(tanggal_penjualan,'%Y-%m') as d"))
                    ->where('deleted','=','0')
                    ->groupBy(DB::raw("DATE_FORMAT(tanggal_penjualan,'%Y-%m')"));

		if($query->count() > 0){
			foreach ($query->get() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
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

    public function logout()
    {   
        Session::put('logged_in',FALSE);
        Session::flush();
        if(!session()->has('logged_in')){
           return redirect('/'); 
        }else{
            return 'Error';
        };
    }
}
