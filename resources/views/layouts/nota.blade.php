<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Pembelian - {{$penjualan->kode_penjualan}}</title>
    <style>
        .line-head-first{
            background: #ffb300;
            width: 100%;
            height: 20px;
            margin-top:10px;
        }
        .line-head-second{
            background: #0d47a1;
            width: 100%;
            height: 15px;
        }
        .line-head-third{
            background: #cfd8dc;
            width: 100%;
            height: 5px;
            margin-bottom:10px;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
        .text-center{
            text-align: center;
        }
        .last{
            padding: 10px;
            font-weight: bold;
        }
        .last-title{
            text-transform: uppercase;
        }
        #table-detail-order{
            border-collapse: collapse;
            border : 1px solid lightgrey;
        }
        #table-detail-order tr th{
            background: #0d47a1;
            text-transform: uppercase;
            color: #ffffff;
            border-bottom: 3px solid #ffb300;
        }
        #table-detail-order tr td{
            border : 1px solid lightgrey;
        }
        #table-head{
            padding: 0;
        }
    </style>
</head>
<body>
    <table width="100%" id="table-head">
        <tr>
            <td rowspan="3"><img src="{{public_path().'/assets/icon/logobasic.png'}}" alt="logo" width="300px"></td>
            <td class="text-right">@basicclass.co</td>
            <td align="right"><img src="{{public_path().'/assets/icon/instagram.png'}}" alt="instagram" width="15px"></td>
        </tr>
        <tr>
            <td class="text-right">+62 8954 6479 1632</td>
            <td align="right"><img src="{{public_path().'/assets/icon/icon.png'}}" alt="phone" width="15px"></td>
        </tr>
        <tr>
            <td class="text-right">Surabaya, Indonesia</td>
            <td align="right"><img src="{{public_path().'/assets/icon/phone.png'}}" alt="maps" width="15px"></td>
        </tr>
    </table>
    <div class="line-head-first"></div>
    <div class="line-head-second"></div>
    <div class="line-head-third"></div>
    <table width="100%" cellpadding="5">
        <tr>
            <td>Penjualan No.</td>
            <td>:</td>
            <td>{{$penjualan->kode_penjualan}}</td>
            <td>Weight</td>
            <td>:</td>
            <td>{{$penjualan->weight}} gram</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$penjualan->nama_pembeli}}</td>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td>{{$penjualan->nomor_telepon}}</td>
        </tr>
        <tr>
            <td>Tanggal Order</td>
            <td>:</td>
            <td>{{ $penjualan->tanggal_penjualan }}</td>
            <td>Status</td>
            <td>:</td>
            <td>{{$penjualan->status}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td colspan="3">{{$penjualan->alamat_pembeli}}</td>
        </tr>
    </table>
    <br>
    <table width="100%" cellpadding="10" id="table-detail-order">
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Size Produk</th>
            <th>Harga</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($details as $row)
            <tr>
                <td>{{$row->kode_produk}}</td>
                <td>{{$row->nama_produk}}</td>
                <td>{{$row->size}}</td>
                <td>Rp {{number_format($row->harga_produk)}}</td>
                <td>{{number_format($row->quantity)}}</td>
                <td>Rp {{number_format($row->subtotal)}}</td>
            </tr>
        @endforeach
            <tr>
                <td colspan="5" class="text-right last-title"><b>Ongkos Kirim</b></td>
                <td class="last">Rp {{number_format($penjualan->ongkos_kirim)}}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-right last-title"><b>Total</b></td>
                <td class="last">Rp {{number_format($penjualan->total)}}</td>
            </tr>
       </table>
       <br>
       <div>
           <em><center><b> Thanks for buy this product </b></center></em>
       </div>
</body>
</html>