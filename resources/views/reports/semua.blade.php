@extends('layout.app')

@section('title', 'Laporan')

@section('content')
@if ($category)
<h1 class="h3 mb-4 text-gray-800">Kategori : {{$category->nama}}</h1>
@else
<h1 class="h3 mb-4 text-gray-800">Semua Laporan</h1>
@endif

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Pengaturan Filter</h6>
            </div>
            <div class="card-body">
                <form>
                    <input type="hidden" name="category_id" value="{{request('category_id')}}">
                    <div class="mb-2">
                        <label for="">Tipe</label>
                        <select name="tipe" id="tipe" class="form-control tipe">
                            <option value="semua">Semua</option>
                            <option value="BARANG KELUAR">BARANG KELUAR</option>
                            <option value="HASIL PRODUKSI">HASIL PRODUKSI</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="">Distributor</label>
                        <select name="distributor_id" id="distributor_id" class="form-control distributor" disabled>
                            <option value="semua">Semua</option>
                            @foreach ($distributors as $distributor)
                            <option value="{{$distributor->id}}">{{$distributor->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="">Dari</label>
                        <input type="date" class="form-control" name="dari" required value="{{request()->get('dari')}}">
                    </div>
                    <div class="mb-4">
                        <label for="">Sampai</label>
                        <input type="date" class="form-control" name="sampai" required
                            value="{{request()->get('sampai')}}">
                    </div>
                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Semua Laporan</h6>
        <div>
            <a target="_blank"
                href="/laporan/cetak_semua?dari={{request('dari')}}&sampai={{request('sampai')}}&tipe={{request('tipe')}}&distributor_id={{request('distributor_id')}}&category_id={{request('category_id')}}"
                class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
            <a href="{{route('laporan')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered datatable-no-search" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Kategori</th>
                        <th>Distributor</th>
                        <th>Stok Awal</th>
                        <th>Jumlah Produksi</th>
                        <th>Jumlah Barang Keluar</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_kuantitas_produksi = 0;
                    $total_barang_keluar = 0;
                    $stok_awal = 0;
                    $stok_akhir = 0;
                    @endphp
                    @foreach ($items as $index => $item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->category->nama}}</td>
                        <td>{{$item->distributor->nama ?? ''}}</td>
                        <td>{{$stok_awal}}</td>

                        @if ($item->tipe == 'BARANG KELUAR')
                        @php
                        $stok_awal -= $item->kuantitas;
                        $stok_akhir = $stok_awal;
                        $total_barang_keluar += $item->kuantitas;
                        @endphp
                        <td>0</td>
                        <td>{{$item->kuantitas}}</td>
                        @else
                        @php
                        $stok_akhir += $item->kuantitas;
                        $stok_awal = $stok_akhir;
                        $total_kuantitas_produksi += $item->kuantitas;
                        @endphp
                        <td>{{$item->kuantitas}}</td>
                        <td>0</td>
                        @endif

                        <td>{{$stok_akhir}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th>{{$total_kuantitas_produksi}}</th>
                        <th>{{$total_barang_keluar}}</th>
                        <th>{{$total_kuantitas_produksi - $total_barang_keluar}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection


@push('js')
<script>
    $(function(){
            $('.tipe').change(function(){
                if($(this).val() == 'BARANG KELUAR'){
                    $('.distributor').prop('disabled', false);
                }else{
                    $('.distributor').val('semua');
                    $('.distributor').prop('disabled', true);
                }
            });
        })
</script>
@endpush
