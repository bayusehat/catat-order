<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pesan;
use App\Product;
use App\DetailPesan;
use PDF;

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
        $produk = Product::select('*')->where('nama_produk','LIKE','%'.$request->searchProduk.'%')->where('deleted','=','0')->get();
        $output = '';
        if(count($produk) >0){
            foreach ($produk as  $row) {
              $output .= 
              '<li>
                  <a href="javascript:void(0)" 
                    class="list" 
                      style="display:block;cursor:pointer" 
                      data-id="'.$row->id_produk.'" 
                      data-kode="'.$row->kode_produk.'"
                      data-nama="'.$row->nama_produk.'"
                      data-harga="'.$row->harga_jual.'"
                      data-profit="'.$row->profit.'"
                      onclick="addToTable(this);">
                    '.$row->nama_produk.'
                  </a>
                </li>';
            }
        }else{
          $output .= '<li>Produk tidak ditemukan</li>';
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

    public function getCityName($id,$id_penjualan)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$id",
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

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        $hasil = json_decode($response,true);
        $kota =  $hasil['rajaongkir']['results']['city_name'];
        Pesan::where('id_penjualan',$id_penjualan)->update([
           'tujuan' => $kota
        ]);
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
        $penjualan = Pesan::create([
          'kode_penjualan' => rand(),
          'tanggal_penjualan' => $request->tanggal_penjualan,
          'nama_pembeli' => $request->nama_pembeli,
          'nomor_telepon' => $request->nomor_hp,
          'alamat_pembeli' => $request->alamat_pembeli,
          'id_tujuan' => $request->tujuan,
          'type_tujuan' => '1',
          'tujuan' => '1',
          'weight' => $request->weight,
          'ongkos_kirim' => '1',
          'kurir' => $request->kurir,
          'id_user' => '1',
          'total' => '0'
        ]);
        $id = $penjualan->id;
        $detail = array();

        foreach ($request->kode_produk as $i => $item) {
            $profit[$i] = $request->qty[$i]*$request->profit[$i];
          $detail[] = array(
            'id_produk' => $request->id_produk[$i],
            'kode_produk' => $request->kode_produk[$i],
            'nama_produk' => $request->nama_produk[$i],
            'harga_produk' => $request->harga_produk[$i],
            'subtotal' => $request->subtotal[$i],
            'quantity' => $request->qty[$i],
            'size' => 'X',
            'profit' => $profit[$i],
            'id_penjualan' => $id 
          );
        }

        $penjualan_detail = DetailPesan::insert($detail);

        $temp_total = $this->generate_total($id);
        $ongkir = $this->getCost($id,$request->tujuan,$request->weight,$request->kurir);
        $this->getCityName($request->tujuan,$id);

        Pesan::where('id_penjualan',$id)->update([
          'total' => $temp_total+$ongkir
        ]);
        
        //JSON result
        $data['data'] = $penjualan;
        $data['data']['detail'] = $detail;

        return response()->json($data);
    }

    public function generate_total($id_penjualan)
    {
        $total = DetailPesan::where('id_penjualan',$id_penjualan)->where('deleted','=','0')->sum('subtotal');
        $pesan = Pesan::where('id_penjualan',$id_penjualan)->first();
        $temp = Pesan::where('id_penjualan',$id_penjualan)->update([
          'total' => $pesan->ongkos_kirim+$total
        ]);

        return $total;
    }

    public function getCost($id_penjualan,$kota_tujuan,$weight,$courier)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=444&destination=$kota_tujuan&weight=$weight&courier=$courier",
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded",
          "key:3275a8000010695a45f9ea333d0145f9"
        ),
      ));
  
      $response = curl_exec($curl);
      $err = curl_error($curl);
  
      curl_close($curl);
  
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        $hasil = json_decode($response,true);
        if($courier == 'jne'){
          $ongkir = $hasil['rajaongkir']['results'][0]['costs'][1]['cost'][0]['value'];
        }else if($courier == 'pos'){
          $ongkir = $hasil['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        }else{
          $ongkir = $hasil['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        }

        $temp = Pesan::where('id_penjualan',$id_penjualan)->update([
            'ongkos_kirim' => $ongkir
          ]);
        return $ongkir;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = Pesan::where('id_penjualan',$id)->first();
        $title = 'Edit Pesanan '.$penjualan->kode_penjualan;
        $details = DetailPesan::where('id_penjualan',$id)->where('deleted','=','0')->get();
        return view('edit.edit_pesan',compact('penjualan','details','title'));
    }

    public function cetakNota($id)
    {
        $penjualan = Pesan::where('id_penjualan',$id)->first();
        $title = 'Nota Pembelian '.$penjualan->kode_penjualan;
        $details = DetailPesan::where('id_penjualan',$id)->where('deleted','=','0')->get();
        $pdf = PDF::loadView('layouts.nota',compact('penjualan','title','details'));
        $pdf->setPaper('a4','portrait');
        return $pdf->stream('Nota Pembelian - '.$penjualan->kode_penjualan.' / '. $penjualan->nama_pembeli);
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
      $penjualan = Pesan::where('id_penjualan',$id)->update([
        'tanggal_penjualan' => $request->tanggal_penjualan,
        'nama_pembeli' => $request->nama_pembeli,
        'nomor_telepon' => $request->nomor_hp,
        'alamat_pembeli' => $request->alamat_pembeli,
        'id_tujuan' => $request->tujuan,
        'type_tujuan' => '1',
        'tujuan' => '1',
        'weight' => $request->weight,
        'ongkos_kirim' => '1',
        'kurir' => $request->kurir,
        'id_user' => '1',
        'total' => '0'
      ]);
      $detail = array();

      foreach ($request->kode_produk as $i => $item) {
          $profit[$i] = $request->qty[$i]*$request->profit[$i];
        $detail[] = array(
          'id_produk' => $request->id_produk[$i],
          'kode_produk' => $request->kode_produk[$i],
          'nama_produk' => $request->nama_produk[$i],
          'harga_produk' => $request->harga_produk[$i],
          'subtotal' => $request->subtotal[$i],
          'quantity' => $request->qty[$i],
          'size' => 'X',
          'profit' => $profit[$i],
          'id_penjualan' => $id 
        );
        // DetailPesan::where('id_penjualan',$id)->update([$detail]);
      }

      // $penjualan_detail = DetailPesan::insert($detail);

      $temp_total = $this->generate_total($id);
      $ongkir = $this->getCost($id,$request->tujuan,$request->weight,$request->kurir);
      $this->getCityName($request->tujuan,$id);

      Pesan::where('id_penjualan',$id)->update([
        'total' => $temp_total+$ongkir
      ]);
      
      //JSON result
      $data['data'] = $penjualan;
      // $data['data']['detail'] = $detail;

      return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Pesan::where('id_penjualan', $id);
        $product->update([
          'deleted' => '1'
        ]);

        return response()->json(['msg' => 'Order deleted']);
    }

    public function deleteOrderDetail($id_detail_penjualan)
    {
        $detail = DetailPesan::where('id_detail_penjualan',$id_detail_penjualan)->first();
        $update = DetailPesan::where('id_detail_penjualan',$id_detail_penjualan)->update([
          'deleted' => '1'
        ]);
        $this->generate_total($detail->id_penjualan);
        return response()->json(['msg' => 'Items deleted']);
    }
}
