@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item ">Produk</li>
        <li class="breadcrumb-item ">Tambah Produk</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Tambah Produk</div>
            <div class="card-body">
                <form method="POST" id="formAddProduk">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6 col-sm-6"> 
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                            </div>
                            <div class="form-group">
                                <label>Kategori Produk</label>
                                <select name="id_kategori_produk" id="id_kategori_produk" class="form-control" style="width:100%">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Produksi</label>
                                <input type="text" class="form-control" name="harga_produksi" id="harga_produksi">
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual">
                            </div>     
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control" name="warna" id="warna">
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="text" class="form-control" name="stok" id="stok">
                            </div>
                            <div class="form-group">
                                <label>Size Produk</label>
                                <input type="text" class="form-control" name="size_produk" id="size_produk">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" class="btn btn-success btn-block" name="submit" id="btnAddProduk" value="Simpan Produk">
                        </div>
                    </div> 
                </form>
            </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#nama_produk").focus();
        });

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

      $("#btnAddProduk").click(function(event){
          event.preventDefault();
          var form_Data = $('form#formAddProduk').serialize();
          var conf = confirm('Apakah anda yakin untuk menyimpan?');
          if(conf){
              $.ajax({
                type:"POST",
                url : "/addProduk",
                dataType : "json",
                data : form_Data,
                beforeSend:function(){
                    $('body').loading();
                },
                complete:function(){
                    $('body').loading('stop');
                },
                success:function(data){
                    swal_success('Produk saved');
                    setTimeout(function () {
                        $('form').trigger('reset');
                    },1000);
                    $("#nama_produk").focus();
                },
                error:function(data){
                   swal_failed('Something wrong!');
                }
            })
          }else{

          }
          
      })
    </script>
@endsection