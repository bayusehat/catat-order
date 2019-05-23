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
                        <a href="/tambahPesan" class="btn btn-success" style="float:right"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-condensed" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Tujuan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesans as $row)
                                    <tr>
                                        <td>{{ $row->kode_penjualan }}</td>
                                        <td>{{ $row->tanggal_penjualan }}</td>
                                        <td>{{ $row->nama_pembeli }}</td>
                                        <td>{{ $row->tujuan }}</td>
                                        <td>Rp {{ number_format($row->total) }}</td>
                                        <td>
                                            <a href="/editPesanan/{{$row->id_penjualan}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger" onclick="deletePesanan({{$row->id_penjualan}})"><i class="fa fa-trash"></i></a>
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