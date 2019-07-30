<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\KategoriProduk;

class KategoriController extends Controller
{
    public function logged()
    {
      if(session()->get('logged_in') != TRUE){
        redirect('/');
      };
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->logged();
        $title = 'Data Kategori';
        $kategoris = KategoriProduk::where('deleted','=','0')->orderBy('created','desc')->get();
        return view('data.data_kategori',compact('kategoris','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->logged();
        $this->validate($request,[
            'nama_kategori_produk' => 'required'
        ]);

        $kategori = KategoriProduK::create([
            'nama_kategori_produk' => $request->nama_kategori_produk,
            'id_user' => '1'
        ]);
        
        if($kategori){
            return response()->json(array('msg'=>'Saved'));
        }else{
            return response()->json(array('msg'=>'Save failed'));
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
        $this->logged();
        $json = [];
        $kategori = DB::table('ct_kategori_produk')
                      ->where('id_kategori_produk',$id)
                      ->first();
        $json = $kategori;
        return response()->json($json);
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
    public function update(Request $request)
    {
        $this->logged();
        $kategori = KategoriProduk::where('id_kategori_produk',$request->edit_id_kategori_produk);
        $kategori->update([
            'nama_kategori_produk' => $request->edit_nama_kategori_produk,
            'id_user' => '1'
        ]);

        if($kategori){
            return response()->json(['msg' => 'Updated']);
        }else{
            return response()->json(['msg' => 'Update failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->logged();
        $product = KategoriProduk::where('id_kategori_produk',$id);
        $product->update([
            'deleted' => '1'
        ]);

        if($product){
            return response()->json(['msg' => 'Deleted']);
        }else{
            return response()->json(['msg' => 'Delete failed']);
        }
    }
}
