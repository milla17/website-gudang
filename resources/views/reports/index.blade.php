@extends('layout.app')

@section('title', 'Daftar Laporan')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Daftar Laporan</h1>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Semua Laporan</h6>
    </div>
    <div class="card-body">
        <span>Kode : Semua Kode Terlampir</span>
        <br>
        <br>

        @php
        $total = \App\Models\Item::count();
        @endphp

        <a href="/laporan/semua" class="btn btn-outline-primary btn-block"><i class="fa fa-eye"></i> Lihat Laporan <div
                class="badge badge-primary">{{$total}}</div></a>
    </div>
</div>

<div class="row">
    @foreach ($categories as $category)
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{$category->nama}}</h6>
            </div>
            <div class="card-body">
                <span>Kode : {{$category->kode}}</span>
                <br>
                <br>
                @php
                $total = \App\Models\Item::where('category_id', $category->id)->count();
                @endphp

                <a href="/laporan/semua?category_id={{$category->id}}" class="btn btn-outline-primary btn-block"><i class="fa fa-eye"></i>
                    Lihat
                    Laporan <div class="badge badge-primary">{{$total}}</div></a>
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection
