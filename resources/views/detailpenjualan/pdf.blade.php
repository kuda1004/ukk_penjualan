<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>

    <h1>Detail Report</h1>
    
    <table>
        <thead>
            <tr>
                <th>Detail ID</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->penjualan->pelanggan->namapelanggan }}</td>
                <td>{{ $detail->produk->namaproduk }}</td>
                <td>{{ $detail->jumlahproduk }}</td>
                <td>{{ number_format($detail->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
