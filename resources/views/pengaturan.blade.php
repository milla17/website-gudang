@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Pengaturan</h1>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
            </div>
            <div class="card-body">

                @if ($message = Session::get('message'))
                <div class="alert alert-success">
                    <strong>Berhasil</strong>
                    <p>{{$message}}</p>
                </div>
                @endif

                @if ($error = Session::get('error'))
                <div class="alert alert-danger">
                    <strong>Gagal</strong>
                    <p>{{$error}}</p>
                </div>
                @endif

                <h3>Update Nama</h3>
                <form action="/update_username" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username"
                                    value="{{Auth::user()->username}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
                </form>

                <h3 class="mt-5">Update Foto</h3>
                <form action="/update_foto" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <img src="/user_images/{{Auth::user()->foto}}" alt="" class="img-fluid">
                            </div>
                            <div class="mb-4">
                                <label for="">Foto</label>
                                <input type="file" class="form-control" name="foto" placeholder="file Lama">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
                </form>

                <h3 class="mt-5">Update Password</h3>
                <form action="/update_password" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="">Password Lama</label>
                                <input type="password" class="form-control" name="old_password"
                                    placeholder="Password Lama">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="">Password Baru</label>
                                <input type="password" class="form-control" name="new_password"
                                    placeholder="Password Baru">
                            </div>
                            @error('new_password')
                            <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" name="new_password_confirmation"
                                    placeholder="Konfirmasi Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
