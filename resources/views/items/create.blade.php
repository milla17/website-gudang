@extends('layout.app')

@section('title', 'Tambah Item')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Item</h1>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Item</h6>
                <a href="{{route('items.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{route('items.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">-- Silahkan Pilih --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Distributor</label>
                                <select name="distributor_id" id="" class="form-control">
                                    <option value="">-- Silahkan Pilih --</option>
                                    @foreach ($distributors as $distributor)
                                    <option value="{{$distributor->id}}">{{$distributor->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kuantitas</label>
                                <input type="number" class="form-control" name="kuantitas" placeholder="Kuantitas"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe</label>
                                <select name="tipe" id="" class="form-control">
                                    <option value="HASIL PRODUKSI">Hasil Produksi</option>
                                    <option value="BARANG KELUAR">Barang Keluar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Input</label>
                                <input type="datetime-local" class="form-control" value="{{date('Y-m-d H:i:s')}}"
                                    name="created_at" placeholder="Tanggal Input" required>
                            </div>
                            <div class="form-group">
                                <label for="">Expired Barang</label>
                                <input type="date" class="form-control" name="expired_barang"
                                    placeholder="Expired Barang" required>
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
