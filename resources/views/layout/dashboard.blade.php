@extends('layout.main')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Total Harga Penjualan -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Harga Penjualan</p>
                            <h5 class="font-weight-bolder mb-0">
                                Rp{{ number_format($totalHargaPenjualan, 2) }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pelanggan -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pelanggan</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $totalPelanggan }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Produk -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Produk</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $totalProduk }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Dashboard Cards (if any) -->
    <!-- Example for Sales -->
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Detail Penjualan</p>
                            <h5 class="font-weight-bolder mb-0">
                            {{ $totalDetail }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
<div class="col-lg-7 mb-5">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Penjualan</h6>
            </div>
            <div class="card-body p-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Total Produk Dibeli</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salesOverview as $item)
                        <tr>
                            <td>{{ $item->namaproduk }}</td>
                            <td>{{ $item->totalbeli }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5 mb-5">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Grafik Penjualan</h6>
            </div>
            <div class="card-body p-3">
                <canvas id="penjualanChart"></canvas>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart.js Configuration for Penjualan Chart
    var ctx = document.getElementById('penjualanChart').getContext('2d');
    var penjualanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($salesOverview as $item)
                    "{{ $item->namaproduk }}",
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Produk Dibeli',
                data: [
                    @foreach($salesOverview as $item)
                        {{ $item->totalbeli }},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value; // Custom formatting (e.g. 'Rp' for currency if needed)
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw; // Format value if needed
                        }
                    }
                }
            }
        }
    });
</script>

@endsection

<!-- Add Chart.js Script -->

