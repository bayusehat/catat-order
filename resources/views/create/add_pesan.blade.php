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
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Tanggal Pesan</label>
                                <input type="text" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan">
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
                            <div class="form-group">
                                <input type="text" class="form-control" id="searchProduk" placeholder="Search Produk">
                            </div>
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
    </script>
@endsection