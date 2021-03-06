@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item active">Pesanan</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Data Pesan</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <a href="/tambahPesan" class="btn btn-success" style="float:right"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped" id="dataPesan" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Pesanan</th>
                                    <th>Customer</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesans as $row)
                                    <tr>
                                        <td>{{ $row->tanggal_penjualan }}</td>
                                        <td>{{ $row->kode_penjualan }}</td>
                                        <td>{{ $row->nama_pembeli }}</td>
                                        <td>
                                            @if ($row->id_tujuan != 0)
                                                {{$row->tujuan}}
                                            @else
                                                {{'COD'}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->status == 'Belum Terbayar')
                                                <div class="badge badge-danger">{{ $row->status }}</div>
                                            @else
                                                <div class="badge badge-success">{{ $row->status }}</div>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($row->total) }}</td>
                                        <td>
                                            <a href="/cetakNota/{{$row->id_penjualan}}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-file"></i></a>
                                            <a href="/editPesanan/{{$row->id_penjualan}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            @if ($row->status == 'Belum Terbayar')
                                                <a href="javascript:void(0)" onclick="changeStatus({{$row->id_penjualan}})" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                            @else
                                                <a href="javascript:void(0)" onclick="changeStatus({{$row->id_penjualan}})" class="btn btn-warning btn-sm"><i class="fa fa-times"></i></a>
                                            @endif
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deletePesanan({{$row->id_penjualan}})"><i class="fa fa-trash"></i></a>
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
        $('#dataPesan').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
        function deletePesanan(id) {
            var conf = confirm('Apakah anda yakin untuk menghapus?');

            if(conf){
                $.ajax({
                    type:"POST",
                    url :"/deletePesanan/"+id,
                    dataType:"json",
                    data : {
                        "_token":"{{ csrf_token() }}",
                        "id_penjualan" : id
                    },
                    beforeSend:function(){
                        $('body').loading();
                    },
                    complete:function(){
                        $('body').loading('stop');
                    },
                    success:function(data){
                        swal_success('Pesanan deleted!');
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    },
                    error:function(data){
                        swal_failed('Something weong');
                    }   
                })
            }
        }

        function changeStatus(id) {
            var conf = confirm('Apakah anda yakin untuk mengubah?');
            if(conf){
                $.ajax({
                    type:"POST",
                    url:"/changeStatus/"+id,
                    dataType:"json",
                    data:{
                        "_token" : "{{ csrf_token() }}",
                        "id_penjualan" : id
                    },
                    beforeSend:function(){
                        $('body').loading();
                    },
                    complete:function(){
                        $('body').loading('stop');
                    },
                    success:function(data){
                        swal_success('Status changed!');
                        setTimeout(function () {  
                            window.location.reload();
                        },1000);
                    },
                    error:function(data){
                        swal_failed('Something wrong!');
                    }
                })
            }else{

            }
        }
    </script>
@endsection