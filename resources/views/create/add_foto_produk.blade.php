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
              Tambah Foto Produk | {{$product->nama_produk}}</div>
            <div class="card-body">
                <form method="POST" id="formAddImgProduk" enctype="multipart/form-data">
                    @method('POST')
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="file" class="form-control" id="imgProduct" name="imgProduct[]" multiple>
                                <input type="hidden" id="id_produk" name="id_produk" value="{{$product->id_produk}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" class="btn btn-success btn-block" name="submit" id="btnAddImgProduk" value="Simpan Foto Produk">
                        </div>
                    </div> 
                </form>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imgProduct as $data)
                                    <tr>
                                        <td>{{$data->img_produk}}</td>
                                        <td>
                                            <a href="#" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
@section('js')
    <script>
         var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $("#formAddImgProduk").on('submit',function(event){
            event.preventDefault();
            var conf = confirm('Apakah anda yakin untuk menyimpan?');
            if(conf){
                $.ajaxSetup({
                    headers:{'X-CSRF-TOKEN' : csrf_token}
                });
                $.ajax({ 
                    type: 'POST',
                    url: "/addImgProduk",
                    contentType: false,
                    dataType: "JSON",
                    mimeType: 'multipart/form-data',
                    processData: false,
                    data:new FormData(this),
                    success: function (data) {
                        alert('Image uploaded');
                    },
                    error: function (error) {
                      alert('Error');
                    }
                })
            }
        })
    </script>
@endsection