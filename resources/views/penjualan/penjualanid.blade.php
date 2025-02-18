<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan ID: {{ $penjualanid }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Penjualan ID: {{ $penjualanid }}</h2>
<p><strong>Nama Pelanggan:</strong> {{ $pelanggan }}</p>
<p><strong>Tanggal Penjualan:</strong> {{ $tanggalpenjualan }}</p>
<p><strong>Total Harga:</strong> Rp. {{ number_format($totalharga, 2, ',', '.') }}</p>

<h3>Produk yang Dibeli:</h3>
<table class="table">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detailPenjualans as $detail)
        <tr>
            <td>{{ $detail->produk->namaproduk }}</td>
            <td>{{ $detail->jumlahproduk }}</td>
            <td>Rp. {{ number_format($detail->produk->harga, 2, ',', '.') }}</td>
            <td>Rp. {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
