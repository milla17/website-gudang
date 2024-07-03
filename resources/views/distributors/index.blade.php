@extends('layout.app')

@section('title', 'Data Distributor')


@section('content')
<h1 class="h3 mb-4 text-gray-800">Daftar Distributor</h1>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Distributor</h6>
        <a href="{{route('distributors.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
            Data</a>
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distributors as $index => $distributor)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$distributor->nama}}</td>
                        <td>{{$distributor->alamat}}</td>
                        <td>{{$distributor->nomor_telepon}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('distributors.edit', $distributor->id)}}" class="btn btn-warning mr-2"><i
                                        class="fa fa-edit"></i> Edit</a>
                                <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="{{route('distributors.destroy', $distributor->id)}}" method="POST">
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
