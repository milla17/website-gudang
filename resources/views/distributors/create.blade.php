@extends('layout.app')

@section('title', 'Tambah Distributor')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Distributor</h1>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Distributor</h6>
                <a href="{{route('distributors.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{route('distributors.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10"
                                    placeholder="Alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="text" class="form-control" name="nomor_telepon" placeholder="Nomor Telepon"
                                    required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-submit btn-block btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
