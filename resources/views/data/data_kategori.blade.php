@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item active">Kategori Produk</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Data Kategori Produk</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddKategori" class="btn btn-success" style="float:right"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-condensed" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategoris as $row)
                                    <tr>
                                        <td>{{ $row->nama_kategori_produk }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalEditKategori" class="btn btn-info btn-sm" onclick="getKategori({{$row->id_kategori_produk}})"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteKategoriProduk({{$row->id_kategori_produk}})"><i class="fa fa-trash"></i></a>
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

    <!-- Modal Add Kategori -->
<form method="POST" id="formAddKategori">
    @csrf
    @method('POST')
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAddKategori">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Kategori Produk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                      <label for="">Nama Kategori Produk</label>
                      <input type="text" class="form-control" name="nama_kategori_produk" id="nama_kategori_produk">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-success" id="btnAddKategori">Simpan Kategori Produk</button>
                </div>
            </div>
        </div>
    </div>
</form>
   <!-- Modal Add Kategori -->
   <form method="POST" id="formEditKategori">
        @csrf
        @method('POST')
        <div class="modal fade" tabindex="-1" role="dialog" id="modalEditKategori">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Kategori Produk <span id="nk"></span></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          <label for="">Nama Kategori Produk</label>
                          <input type="text" class="form-control" name="edit_nama_kategori_produk" id="edit_nama_kategori_produk">
                          <input type="hidden" class="form-control" name="edit_id_kategori_produk" id="edit_id_kategori_produk">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-info" id="btnAddKategori" onclick="updateKategori()">Update Kategori Produk</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $("#btnAddKategori").click(function (event) { 
            event.preventDefault();
            var conf = confirm('Apakah anda yakin untuk menyimpan?');
            var token = $("input[name='_token']").val();
            console.log(token);
            if(conf){
                $.ajax({
                    type:"POST",
                    url:"/addKategori",
                    dataType:"json",
                    data:{
                        "_token" : token,
                        "nama_kategori_produk" : $("#nama_kategori_produk").val()
                    },
                    beforeSend:function(){
                        $('body').loading();
                    },
                    complete:function(){
                        $('body').loading('stop');
                    },
                    success:function(data){
                        $("#modalAddKategori").hide();
                        swal_success('Kategori produk saved!');
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    },
                    error:function(data){
                        swal_failed('Something wrong!');
                    }
                })
            }
         })

        function getKategori(id){
            $.ajax({
                type:"GET",
                url:"/editKategori/"+id,
                dataType:"json",
                success:function(data){
                    $("#nk").html(data.nama_kategori_produk);
                    $("#edit_nama_kategori_produk").val(data.nama_kategori_produk);
                    $("#edit_id_kategori_produk").val(data.id_kategori_produk);
                },
                error:function(data){
                    console.log(data);
                }
            })
        }

        function updateKategori(){
            var conf = confirm('Apakah anda yakin mengubah?');
            var token = $("input[name='_token']").attr('value');

            if(conf){
                $.ajax({
                    type:"POST",
                    url : "/updateKategori",
                    dataType : "json",
                    data:{
                        "_token" : token,
                        "edit_nama_kategori_produk" : $("#edit_nama_kategori_produk").val(),
                        "edit_id_kategori_produk" : $("#edit_id_kategori_produk").val()
                    },
                    beforeSend:function(){
                        $('body').loading();
                    },
                    complete:function(){
                        $('body').loading('stop');
                    },
                    success:function(data){
                        $("#modalEditkategori").hide();
                        swal_success('Kategori updated!');
                        setTimeout(function() {
                             window.location.reload();
                        },1000);
                    },
                    error:function(data){
                        swal_failed('Something wrong!');
                    }
                })
            }
        }
        function deleteKategoriProduk(id){
            var conf = confirm('Apakah anda yakin menghapus?');

            if(conf){
                $.ajax({
                    type : "POST",
                    url : "/deleteKategoriProduk/"+id,
                    dataType : "json",
                    data : {
                        "_token": "{{ csrf_token() }}",
                        "id_kategori_produk": id
                    },
                    beforeSend:function(){
                        $('body').loading();
                    },
                    complete:function(){
                        $('body').loading('stop');
                    },
                    success:function(data){
                        swal_success('Kategori deleted!');
                        setTimeout(function() {
                             window.location.reload();
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