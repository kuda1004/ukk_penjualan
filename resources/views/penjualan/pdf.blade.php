<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>

    <h1>Penjualan Report</h1>
    
    <table>
        <thead>
            <tr>
                <th>Penjualan ID</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $penjualan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penjualan->pelanggan->namapelanggan }}</td>
                <td>{{ $penjualan->tanggalpenjualan }}</td>
                <td>{{ number_format($penjualan->totalharga, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
