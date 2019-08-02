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
          Data Pengeluaran</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <a href="/addPengeluaran" class="btn btn-success" style="float:right"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        <hr>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-bordered table-striped table-condensed" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal Pengeluaran</th>
                                <th>Keterangan</th>
                                <th>Total Pengeluaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div class="card-footer small text-muted"></div>
</div>
@endsection
@section('js')
    
@endsection