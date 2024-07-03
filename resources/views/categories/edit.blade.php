@extends('layout.app')

@section('title', 'Tambah Kategori')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Kategori</h1>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Kategori</h6>
                <a href="{{route('categories.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{route('categories.update', $category->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" value="{{$category->kode}}" class="form-control" name="kode"
                                    placeholder="Kode" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" value="{{$category->nama}}" class="form-control" name="nama"
                                    placeholder="Nama" required>
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
