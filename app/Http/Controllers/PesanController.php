<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pesan;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Pesanan';
        $pesans = Pesan::where('deleted','=','0')->orderBy('tanggal_penjualan','desc')->get();
        return view('data.data_pesan',compact('pesans','title'));
    }

    public function searchProduk(Request $request)
    {
        $produk = Product::select('*')->where('nama_produk','LIKE',$request->searchProduk.'%')->get();
        $output = '';
        if(count($produk) >0){
          $output .= '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
            foreach ($produk as  $row) {
              $output .= '<a href="javascript:void(0)" data-id="'.$row->id_produk.'"><li class="list-group-item">'.$row->nama_produk.'</li></a>';
            }
          $output .= "</ul>";
        }else{
          $output .= '<a href="javascript:void(0)"><li class="list-group-item">Produk tidak ditemukan</li></a>';
        }

        return $output;
    }

    public function getCity()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key:3275a8000010695a45f9ea333d0145f9"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);
      $json = [];
      $json = $response;
      if ($err) {
        return "cURL Error #:" . $err;
      }else {
        return json_decode($json,true);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Pesanan";
        $city = $this->getCity();
        return view('create.add_pesan',compact('title','city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
