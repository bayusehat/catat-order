<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Pembelian - {{$penjualan->kode_penjualan}}</title>
    <style>
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
            src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
        }
        .line-head{
            background: #ffb300;
            width: 100%;
            height: 30px;
            margin: 10px 0px 10px 0px;
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
            <td rowspan="3"><h1 class="logo">BASICCLASS.CO</h1></td>
            <td class="text-right">@basicclass.co</td>
            <td align="right"><img src="{{public_path().'/assets/icon/instagram.png'}}" alt="instagram" width="15px"></td>
        </tr>
        <tr>
            <td class="text-right">+62 8954 6479 1632</td>
            <td align="right"><img src="{{public_path().'/assets/icon/icon.png'}}" alt="instagram" width="15px"></td>
        </tr>
        <tr>
            <td class="text-right">Surabaya, Indonesia</td>
            <td align="right"><img src="{{public_path().'/assets/icon/phone.png'}}" alt="instagram" width="15px"></td>
        </tr>
    </table>
    <div class="line-head"></div>
    <table width="100%" cellpadding="5">
        <tr>
            <td>Penjualan No.</td>
            <td>:</td>
            <td>{{$penjualan->kode_penjualan}}</td>
            <td>Tanggal Order</td>
            <td>:</td>
            <td>{{date('d F Y',strtotime($penjualan->tanggal_penjualan))}}</td>
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
            <td>Alamat</td>
            <td>:</td>
            <td>{{$penjualan->alamat_pembeli}}</td>
            <td>Status</td>
            <td>:</td>
            <td>{{$penjualan->status}}</td>
        </tr>
    </table>
    <br>
    <table width="100%" cellpadding="10" id="table-detail-order">
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($details as $row)
            <tr>
                <td>{{$row->kode_produk}}</td>
                <td>{{$row->nama_produk}}</td>
                <td>Rp {{number_format($row->harga_produk)}}</td>
                <td>{{number_format($row->quantity)}}</td>
                <td>Rp {{number_format($row->subtotal)}}</td>
            </tr>
        @endforeach
            <tr>
                <td colspan="4" class="text-right last-title"><b>Ongkos Kirim</b></td>
                <td class="last">Rp {{number_format($penjualan->ongkos_kirim)}}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right last-title"><b>Total</b></td>
                <td class="last">Rp {{number_format($penjualan->total)}}</td>
            </tr>
       </table>
       <br>
       <div>
           <em><center><b> Thanks for buy this product </b></center></em>
       </div>
</body>
</html>