@extends('layout.app')

@section('title', 'Data Barang')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Daftar Barang</h1>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
        <a href="{{route('items.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            @if ($message = Session::get('message'))
            <div class="alert alert-success">
                <strong>Berhasil</strong>
                <p>{{$message}}</p>
            </div>
            @endif

            <table class="table table-bordered datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Distributor</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Ditambahkan Oleh</th>
                        <th>Tanggal Input</th>
                        <th>Tanggal Expired</th>
                        <th><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->category->kode}}</td>
                        <td>{{$item->category->nama}}</td>
                        <td>{{$item->distributor->nama ?? '-'}}</td>
                        <td>{{$item->tipe}}</td>
                        <td>{{$item->kuantitas}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                        <td>{{ date('d-m-Y', strtotime($item->expired_barang))}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('items.edit', $item->id)}}" class="btn btn-warning mr-2"><i
                                        class="fa fa-edit"></i> Edit</a>
                                <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                    action="{{route('items.destroy', $item->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                        Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
