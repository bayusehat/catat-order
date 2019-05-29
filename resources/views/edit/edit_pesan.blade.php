@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item ">Pesanan</li>
        <li class="breadcrumb-item ">{{$title}}</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Tambah Pesanan</div>
            <div class="card-body">
                <form method="POST" id="formEditPesanan">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Tanggal Pesan</label>
                                <input type="text" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan" value="{{date('Y-m-d',strtotime($penjualan->tanggal_penjualan))}}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Nama Pembeli</label>
                                <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" value="{{$penjualan->nama_pembeli}}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Nomor Handphone</label>
                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{$penjualan->nomor_telepon}}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Alamat Pembeli</label>
                                <input type="text" name="alamat_pembeli" id="alamat_pembeli" class="form-control" value="{{$penjualan->alamat_pembeli}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="form-control" style="width:100%">
                                    <option value="{{$penjualan->id_tujuan}}">{{$penjualan->tujuan}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Weight (kg)</label>
                                <input type="text" name="weight" id="weight" class="form-control" value="{{$penjualan->weight}}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Kurir</label>
                                <select name="kurir" id="kurir" class="form-control">
                                    <option value="{{$penjualan->kurir}}">{{$penjualan->kurir}}</option>
                                    <option value="jne">
                                        JNE (REG)
                                    </option>
                                    <option value="pos">
                                        POS Indonesia (Kilat Khusus)
                                    </option>
                                    <option value="tiki">
                                        TIKI (ECO)
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
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
                                <table class="table table-bordered table-striped" id="tableOrder">
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
                                        @foreach ($details as $row)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="id_detail_penjualan[]" value="{{$row->id_detail_penjualan}}" class="form-control">
                                                    <input type="hidden" name="id_produk[]" value="{{$row->id_produk}}" class="form-control">
                                                    <input type="text" name="kode_produk[]" value="{{$row->kode_produk}}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="nama_produk[]" value="{{$row->nama_produk}}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number" name="harga_produk[]" value="{{$row->harga_produk}}" class="form-control harga_produk">
                                                    <input type="hidden" name="profit[]" value="{{$row->profit}}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number" name="qty[]" value="{{$row->quantity}}" class="form-control quantity" onkeyup="quantity()">
                                                </td>
                                                <td>
                                                    <input type="number" name="subtotal[]" value="{{$row->subtotal}}" class="form-control subtotal">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-block del" onclick="deleteOrderDetail({{$row->id_detail_penjualan}})"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <hr>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" class="btn btn-info btn-block" name="submit" id="btnUpdatePesanan" onclick="editPesanan(event,{{$penjualan->id_penjualan}})" value="Update Pesanan">
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
          data: function(params){
                return{
                    id_tujuan: params.term
                };
            },
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
                    '<input type="number" name="harga_produk['+i+']" value="'+harga+'" class="form-control harga_produk">'+
                    '<input type="hidden" name="profit['+i+']" value="'+profit+'" class="form-control">'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="qty['+i+']" value="'+qty+'" class="form-control quantity" onkeyup="quantity()">'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="subtotal['+i+']" value="'+subtotal+'" class="form-control subtotal">'+
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

    // $("#formAddPesanan").delegate("button.del","click",function(){
    //     $(this).closest("tr").remove();
    // });

    function quantity() {
      var sum = 0;
          $('#tableOrder> tbody  > tr').each(function() {
              var id = $(this).find('.id').val();
              var qty = $(this).find('.quantity').val();
              var price = $(this).find('.harga_produk').val();
              var amount = (qty*price)
              sum+=amount;
              $(this).find('.subtotal').val(amount);
          });
    }

    function deleteOrderDetail(id){
        var conf = confirm('Apakah anda yakin untuk menghapus?');
        if(conf){
            $.ajax({
                type:"POST",
                url : "/deleteOrderDetail/"+id,
                dataType:"json",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    "id_detail_penjualan" : id
                },
                success:function(data){
                    alert(data.msg);
                    window.location.reload();
                },
                error:function(data){
                    alert('Error');
                }
            });
        }else{

        }
    }

    function editPesanan(event,id){
        event.preventDefault();
        var formData = $('form#formEditPesanan').serialize();
        var conf = confirm('Apakah anda yakin ingin menghapus?');

        if(conf){
            $.ajax({
                type:"POST",
                url:"/updatePesanan/"+id,
                dataType:"json",
                data : formData,
                success:function(data){
                    alert('Order updated');
                    window.location.reload();
                },
                error:function(data){
                    alert('Error');
                }
            })
        }
    }
        
    </script>
@endsection