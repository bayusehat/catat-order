@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item ">Pesanan</li>
        <li class="breadcrumb-item ">Tambah Pesanan</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Tambah Pesanan</div>
            <div class="card-body">
                <form method="POST" id="formAddPesanan">
                    @method('POST')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Tanggal Pesan</label>
                                <input type="text" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan" value="{{date('Y-m-d')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pembeli</label>
                                <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Handphone</label>
                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pembeli</label>
                                <textarea name="alamat_pembeli" id="alamat_pembeli" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="form-control" style="width:100%"></select>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <div class="form-group has-feedback has-search">
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
                                <input type="text" class="form-control" id="searchProduk" name="searchProduk" placeholder="Search Produk">
								    <div id="suggestions">
								        <div id="autoSuggestionsList">
								        </div>
								    </div>
							    </div>
                            {{-- <div class="form-group">
                                <input type="text" class="form-control" id="searchProduk" name="searchProduk" placeholder="Search Produk">
                            </div> --}}
                            <div id="product-list"></div>
                            <hr>
                            <div class="scroll">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fillProduct">
                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" class="btn btn-success btn-block" name="submit" id="btnAddPesanan" value="Simpan Pesanan">
                        </div>
                    </div> 
                </form>
            </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
@section('js')
    <script>
        var i = 0;
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        console.log(csrf_token);

        $('#tujuan').select2({
        theme:'bootstrap',
        placeholder: 'Pilih Tujuan',
        ajax: {
          url: '/getCity',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: $.map(data.rajaongkir.results, function(item) {
                    return {
                        id: item.city_id,
                        value : item.city_id,
                        text: item.city_name,
                    }
                })
            };
          },
          cache: true
        }
      });

      $("#searchProduk").on('keyup',function(){
          $.ajax({
              type:"GET",
              url:"/searchProduk",
              data:{
                  searchProduk : $("#searchProduk").val()
              },
              success:function(data){
                  if($("#searchProduk").val() != ''){
                    if (data.length > 0) {
                        $('#suggestions').show();
                        $('#autoSuggestionsList').addClass('auto_list');
                        $('#autoSuggestionsList').html(data);
                    }
                  }else{
                    $("#suggestions").slideUp('slow').hide();
                  }
              }
          });
      });
    
    function addToTable(e){
        var id = $(e).data('id');
        var kode = $(e).data('kode');
        var nama = $(e).data('nama');
        var harga = $(e).data('harga');
        var profit = $(e).data('profit');
        var qty = 1;
        var subtotal = harga*qty;

        $("#fillProduct").append(
            '<tr>'+
                '<td>'+
                    '<input type="hidden" name="id_produk['+i+']" value="'+id+'" class="form-control">'+
                    '<input type="text" name="kode_produk['+i+']" value="'+kode+'" class="form-control">'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="nama_produk['+i+']" value="'+nama+'" class="form-control">'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="harga_produk['+i+']" value="'+harga+'" class="form-control">'+
                    '<input type="hidden" name="profit['+i+']" value="'+profit+'" class="form-control">'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="qty['+i+']" value="'+qty+'" class="form-control">'+
                '</td>'+
                '<td>'+
                    '<input type="umber" name="subtotal['+i+']" value="'+subtotal+'" class="form-control">'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-block del"><i class="fa fa-trash"></i></button>'+
                '</td>'+
            '</tr>'
            ); 
        i++;
        $("#suggestions").hide();
        $("#searchProduk").val("").focus();
    }

    $("#formAddPesan").delegate("button.del","click",function(){
        $(this).closest("tr").remove();
    });

    $("#btnAddPesanan").click(function(event){
        event.preventDefault();
        var formdata= $('form').serialize();
        var token = $("input[name='_token']").val();
        var conf = confirm('Apakah anda yakin untuk menyimpan?');

        if(conf){
            $.ajaxSetup({
                headers:{'X-CSRF-TOKEN' : csrf_token}
            });
            $.ajax({
                type:"POST",
                url:"/addPesan",
                dataType:"json",
                data : formdata,
                success:function(data){
                    alert('Order saved');
                    window.location.reload();
                },
                error:function(data){
                    alert(data.msg);
                }
            })
        }else{

        }
    })
    </script>
@endsection