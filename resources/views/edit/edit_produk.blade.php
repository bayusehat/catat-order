@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item ">Produk</li>
        <li class="breadcrumb-item ">Edit Produk {{$product->nama_produk}}</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Tambah Produk</div>
            <div class="card-body">
                <form method="POST" id="formEditProduk">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-sm-6"> 
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{$product->nama_produk}}">
                            </div>
                            <div class="form-group">
                                <label>Kategori Produk</label>
                                <select name="id_kategori_produk" id="id_kategori_produk" class="form-control" style="width:100%">
                                    <option value="{{$product->id_kategori_produk}}">{{$product->nama_kategori_produk}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Produksi</label>
                                <input type="text" class="form-control" name="harga_produksi" id="harga_produksi" value="{{$product->harga_produksi}}">
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="{{$product->harga_jual}}">
                            </div>     
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control" name="warna" id="warna" value="{{$product->warna}}">
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="text" class="form-control" name="stok" id="stok" value="{{$product->stok}}">
                            </div>
                            <div class="form-group">
                                <label>Size Produk</label>
                                <input type="text" class="form-control" name="size_produk" id="size_produk" value="{{$product->size_produk}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" class="btn btn-info btn-block" name="submit" id="btnEditProduk" value="Update Produk" onclick="editProduk(event,{{ $product->id_produk }})">
                        </div>
                    </div> 
                </form>
            </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    
@endsection
@section('js')
    <script>
        $('#id_kategori_produk').select2({
        theme:'bootstrap',
        placeholder: 'Pilih Kategori',
        ajax: {
          url: '/search_kategori',
          dataType: 'json',
          delay: 250,
          data: function(params){
                return{
                    id_kategori_produk: params.term
                };
            },
          processResults: function (data) {
            console.log(data);
            return {
              results: $.map(data, function(item) {
                    return {
                        id: item.id_kategori_produk,
                        value : item.id_kategori_produk,
                        text: item.nama_kategori_produk
                    }
                })
            };
          },
          cache: true
        }
      });

    function editProduk(event,id) {
        event.preventDefault();
        var form_Data = $('form#formEditProduk').serialize();
        var conf = confirm('Apakah anda yakin untuk mengubah?');

        if(conf){
            $.ajax({
                type:"POST",
                url:"/updateProduk/"+id,
                dataType:"json",
                data : form_Data,
                beforeSend:function(){
                    $('body').loading();
                },
                complete:function(){
                    $('body').loading('stop');
                },
                success:function(data){
                    swal_success('Produk updated');
                    setTimeout(function () {
                        window.location = "/pesan";
                    },1000);
                },
                error:function(data){
                    swal_failed('Something wrong!');
                }
            })
        }
      }
</script>
@endsection