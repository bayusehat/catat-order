<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Pembelian - {{$penjualan->kode_penjualan}}</title>
</head>
<body>
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
            <td>Nama Pembeli</td>
            <td>:</td>
            <td>{{$penjualan->nama_pembeli}}</td>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td>{{$penjualan->nomor_telepon}}</td>
        </tr>
        <tr>
            <td>Alamat Pembeli</td>
            <td>:</td>
            <td>{{$penjualan->alamat_pembeli}}</td>
            <td>Status</td>
            <td>:</td>
            <td>{{$penjualan->status}}</td>
        </tr>
    </table>
    <hr>
    <table width="100%" border="1" class="table table-borderen table-striped" cellpadding="10">
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
                <td>Rp {{number_format($row->quantity)}}</td>
                <td>Rp {{number_format($row->subtotal)}}</td>
            </tr>
        @endforeach
            <tr>
                <td colspan="4" align="right">Ongkos Kirim</td>
                <td>Rp {{number_format($penjualan->ongkos_kirim)}}</td>
            </tr>
            <tr>
                <td colspan="4" align="right">Total</td>
                <td>Rp {{number_format($penjualan->total)}}</td>
            </tr>
       </table>
</body>
</html>