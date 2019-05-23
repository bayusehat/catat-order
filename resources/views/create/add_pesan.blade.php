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
                        <div class="col-md-12">
                            <h1>Hi! Add new Order now</h1>
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