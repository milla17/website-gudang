@extends('layout.app')

@section('title', 'Edit Item')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Item</h1>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Item</h6>
                <a href="{{route('items.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{route('items.update', $item->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">-- Silahkan Pilih --</option>
                                    @foreach ($categories as $category)
                                    <option {{$item->category_id == $category->id ? 'selected' : ''}}
                                        value="{{$category->id}}">{{$category->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Distributor</label>
                                <select name="distributor_id" id="" class="form-control">
                                    <option value="">-- Silahkan Pilih --</option>
                                    @foreach ($distributors as $distributor)
                                    <option {{$item->distributor_id == $distributor->id ? 'selected' : ''}}
                                        value="{{$distributor->id}}">{{$distributor->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kuantitas</label>
                                <input type="number" class="form-control" value="{{$item->kuantitas}}" name="kuantitas"
                                    placeholder="Kuantitas" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe</label>
                                <select name="tipe" id="" class="form-control">
                                    <option {{$item->tipe == "HASIL PRODUKSI" ? 'selected' : ''}} value="HASIL PRODUKSI">Hasil Produksi</option>
                                    <option {{$item->tipe == "BARANG KELUAR" ? 'selected' : ''}} value="BARANG KELUAR">Barang Keluar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Input</label>
                                <input type="datetime-local" class="form-control" value="{{$item->created_at}}" name="created_at"
                                    placeholder="Tanggal Input" required>
                            </div>
                            <div class="form-group">
                                <label for="">Expired Barang</label>
                                <input type="date" class="form-control" value="{{$item->expired_barang}}"
                                    name="expired_barang" placeholder="Expired Barang" required>
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
