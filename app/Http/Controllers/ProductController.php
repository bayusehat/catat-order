<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\KategoriProduk;
use App\DetailProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $title = 'Data Produk';
        $products = DB::table('ct_produk')
                            ->join('ct_kategori_produk','ct_produk.id_kategori_produk','=','ct_kategori_produk.id_kategori_produk')
                            ->select('ct_produk.*','ct_kategori_produk.nama_kategori_produk')
                            ->where('ct_produk.deleted','=','0')
                            ->orderBy('ct_produk.id_produk','DESC')
                            ->get();
        return view('data/data_produk',compact('products','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Produk';
        $kategori = KategoriProduk::where('deleted','=','0')->get();
        return view('create.add_produk',compact('title','kategori'));
    }

    public function searchKategoriProduk()
    {
        $q = \Request::input('id_kategori_produk');
        $kategori = new KategoriProduk;
        $kategoris = $kategori->getAutocomplete($q);
        echo json_encode($kategoris);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_produk' => 'required',
            'harga_produksi' => 'required',
            'harga_jual' => 'required',
            'id_kategori_produk' => 'required'
        ]);
        $profit = $request->harga_jual - $request->harga_produksi;

        $product = Product::create([
            'kode_produk' => rand(),
            'nama_produk' => $request->nama_produk,
            'size_produk' => $request->size_produk,
            'harga_produksi' => $request->harga_produksi,
            'harga_jual' => $request->harga_jual,
            'profit' => $profit,
            'id_kategori_produk' => $request->id_kategori_produk,
            'warna' => $request->warna,
            'stok' => $request->stok,
            'id_user' => '1'
        ]);

       if($product){
           return response()->json(array('msg' => 'Saved'));
       }else{
           return response()->json(array('msg' => getMessage()));
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
        $title = 'Edit Produk';
        $product = DB::table('ct_produk')
                            ->join('ct_kategori_produk','ct_produk.id_kategori_produk','=','ct_kategori_produk.id_kategori_produk')
                            ->select('ct_produk.*','ct_kategori_produk.nama_kategori_produk')
                            ->where('ct_produk.deleted','=','0')
                            ->orderBy('ct_produk.id_produk','DESC')
                            ->first();
        return view('edit.edit_produk',compact('product','title'));
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
        $product = Product::where('id_produk',$id);
        $profit = $request->harga_jual - $request->harga_produksi;
        $product->update([
            'nama_produk' => $request->nama_produk,
            'size_produk' => $request->size_produk,
            'harga_produksi' => $request->harga_produksi,
            'harga_jual' => $request->harga_jual,
            'profit' => $profit,
            'id_kategori_produk' => $request->id_kategori_produk,
            'warna' => $request->warna,
            'stok' => $request->stok,
            'id_user' => '1'
        ]);

        if($product){
            return response()->json(array('msg'=>'Updated'));
        }else{
            return response()->json(array('msg' =>'Update failed'));
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
        $product = Product::where('id_produk',$id);
        $product->update(['deleted' => '1']);

        if($product){
            return response()->json(array('msg' => 'Deleted'));
        }else{
            return response()->json(array('msg' => 'Delete failed'));
        }
    }

    public function tambahImgProduk($id)
    {
        $product = Product::where('id_produk',$id)->first();
        $imgProduct = $this->getImgProduk($id);
        $title = "Tambah Foto Produk";
        return view('create.add_foto_produk',compact('product','title','imgProduct'));
    }

    public function addImgProduk(Request $request)
    {
        $validation = $request->validate([
            'imgProduct.*' => 'required|file|image|mimes:jpeg,png'
        ]);

        $files = $request->file('imgProduct');
        $id_produk = $request->id_produk;

        $folder = [];

        foreach($files as $file){
            $filename = $file->getClientOriginalName();
            $folder[] = $file->storeAs('uploads',$filename);

            DetailProduct::create([
                'img_produk' => $filename,
                'id_produk' => $id_produk
            ]);
        }

        return response()->json(['msg' => 'sukses']);
    }

    public function getImgProduk($id)
    {
        $products = DetailProduct::where('id_produk',$id)->where('deleted','=','0')->get();
        return $products;
    }
}
