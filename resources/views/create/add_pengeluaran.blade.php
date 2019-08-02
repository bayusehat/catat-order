@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6">

        </div>
        <div class="col-md-6 col-sm-6">
            <a href="/pesan" class="btn btn-danger" style="float:right"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Tambah Pengeluaran</div>
            <div class="card-body">
                <form method="POST" id="formAddPengeluaran">
                    @method('POST')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal Pengeluaran</label>
                                <input type="text" class="form-control" name="tanggal_pengeluaran" id="tanggal_pengeluaran" placeholder="yyy-mm-dd" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Title Pengeluaran</label>
                            <input type="text" class="form-control" name="title_pengeluaran" placeholder="Title Pengeluaran" required>
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {{-- <div class="form-group">
                                <input type="text" class="form-control" id="searchProduk" name="searchProduk" placeholder="Search Produk">
                            </div> --}}
                            <div id="product-list"></div>
                        <hr>
                            <div class="scroll">
                                <table class="table table-bordered table-striped" id="tableOrder">
                                    <thead>
                                        <tr>
                                            <th>Pengeluaran</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody id="fillProduct">
                                        <tr id="totalItems">
                                            <td colspan="2">
                                                <h4 class="right">Total</h4>
                                            </td>
                                            <td colspan="2">
                                                <h4 id="total">0</h4>
                                            </td>
                                        </tr>
                                        <tr id="btnNewItems">
                                            <td colspan="4">
                                                <button type="button" class="btn btn-info right" id="btnAddItems"><i class="fa fa-plus"></i> New Items</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <hr>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" class="btn btn-success btn-block" name="submit" id="btnAddPengeluaran" value="Simpan Pengeluaran">
                        </div>
                    </div> 
                </form>
            </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
@section('js')
    <script>
        $("#btnAddItems").click(function(){
            var row = '<tr>'+
                        '<td>'+
                            '<input type="text" name="nama_pengeluaran" class="form-control" placeholder="Nama Pengeluaran" required>'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required>'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="nominal" class="form-control nominal" placeholder="Nominal" onkeyup="setNominal();" required>'+
                        '</td>'+
                        '<td>'+
                            '<button type="button" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>'+
                        '</td>'+
            '</tr>';
            $(row).insertBefore("#totalItems");
        });

        $("#formAddPengeluaran").delegate('button.delete','click', function(){
            $(this).closest("tr").remove();
            total();
        });

        $("#tanggal_pengeluaran").datepicker({dateFormat: 'yy-mm-dd'});

        function total(){
            var sum = 0;

            $(".nominal").each(function() {
                var value = $(this).val();
                
                if(!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });

            $("#total").text(sum);
        }

        function setNominal(){
            total();
        }
    </script>
@endsection