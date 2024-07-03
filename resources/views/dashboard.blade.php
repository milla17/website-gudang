@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Dashboard Page</h1>

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Kategori</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Category::count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Distributor</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Distributor::count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Barang Keluar
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{\App\Models\Item::where('tipe', 'BARANG KELUAR')->count()}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data Hasil Produksi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{\App\Models\Item::where('tipe', 'HASIL PRODUKSI')->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="myBarChart"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Stok</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Stok Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $items = DB::table('items')
                            ->select('categories.nama', 'items.kuantitas', 'categories.id')
                            ->join('categories', 'items.category_id', '=', 'categories.id')
                            ->groupBy('categories.id')
                            ->orderBy('items.id', 'DESC')
                            ->get();
                            @endphp

                            @foreach ($items as $index => $item)

                            @php
                                $produksi = DB::table('items')->where('tipe', 'HASIL PRODUKSI')->where('category_id', $item->id)->sum('kuantitas');
                                $keluar = DB::table('items')->where('tipe', 'BARANG KELUAR')->where('category_id', $item->id)->sum('kuantitas');
                            @endphp
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$produksi - $keluar}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">5 Hasil Produksi Terakhir</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $items = DB::table('items')
                            ->select('categories.nama', 'items.kuantitas', 'categories.id')
                            ->join('categories', 'items.category_id', '=', 'categories.id')
                            ->groupBy('categories.id')
                            ->orderBy('items.id', 'DESC')
                            ->where('tipe', 'HASIL PRODUKSI')
                            ->limit(5)
                            ->get();
                            @endphp



                            @foreach ($items as $index => $item)

                            @php
                                $produksi = DB::table('items')->where('tipe', 'HASIL PRODUKSI')->where('category_id', $item->id)->sum('kuantitas');

                                @endphp
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$produksi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">5 Barang Keluar Terakhir</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $items = DB::table('items')
                            ->select('categories.nama', 'items.kuantitas', 'categories.id')
                            ->join('categories', 'items.category_id', '=', 'categories.id')
                            ->groupBy('categories.id')
                            ->orderBy('items.id', 'DESC')
                            ->where('tipe', 'BARANG KELUAR')
                            ->limit(5)
                            ->get();
                            @endphp

                            @foreach ($items as $index => $item)
                            @php

                            $keluar = DB::table('items')->where('tipe', 'BARANG KELUAR')->where('category_id', $item->id)->sum('kuantitas');
                            @endphp
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{ $keluar}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script>
    $(function(){
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"SegoeUI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        const dataJSON = <?php echo $grafik; ?>;
        const categories = dataJSON.kategori.map((item) => item.nama);
        const totalProduksi = dataJSON.kategori.map((item) => item.total_produksi);
        const totalBarangKeluar = dataJSON.kategori.map((item) => item.total_barang_keluar);
        const totalStokSekarang = dataJSON.kategori.map((item) => item.stok);

        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
           labels: categories,
           datasets: [{
                label: 'Total Barang Produksi',
                data: totalProduksi, // Data untuk batang pertama
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1
            }, {
                label: 'Total Barang Keluar',
                data: totalBarangKeluar, // Data untuk batang kedua
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Total Stok Sekarang',
                data: totalStokSekarang, // Data untuk batang ketiga
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
                xAxes: [{
                    time: {
                    unit: 'month'
                    },
                    gridLines: {
                    display: false,
                    drawBorder: false
                    },
                    ticks: {
                    maxTicksLimit: 6
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    callback: function(value, index, values) {
                        return value
                    }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: true
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + tooltipItem.yLabel;
                    }
                }
            },
        }
        });
    })
</script>
@endpush
