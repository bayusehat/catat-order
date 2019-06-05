@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Data Produk</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <a href="/tambahproduk" class="btn btn-success" style="float:right"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-condensed" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori Produk</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $row)
                                    <tr>
                                        <td>{{ $row->kode_produk }}</td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td>{{ $row->nama_kategori_produk }}</td>
                                        <td>Rp {{ number_format($row->harga_jual) }}</td>
                                        <td>
                                            <a href="/editProduk/{{$row->id_produk}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="/tambahImgProduk/{{$row->id_produk}}" class="btn btn-primary"><i class="fa fa-image"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteProduk({{$row->id_produk}})"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <div class="card-footer small text-muted"></div>
    </div>
@endsection
@section('js')
    <script>
        function deleteProduk(id){
            var conf = confirm('Apakah anda yakin menghapus?');

            if(conf){
                $.ajax({
                    type : "POST",
                    url : "/deleteProduk/"+id,
                    dataType : "json",
                    data : {
                        "_token": "{{ csrf_token() }}",
                        "id_produk": id
                    },
                    success:function(data){
                        swal_success('Produk with '+id+' deleted!');
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    },
                    error:function(data){
                        swal_failed('Somthing wrong!');
                    }
                })
            }
        }
    </script>
@endsection