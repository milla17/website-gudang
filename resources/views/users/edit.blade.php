@extends('layout.app')

@section('title', 'Edit User')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit User</h1>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data User</h6>
                <a href="{{route('users.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                    placeholder="Nama" required>
                            </div>
                            @error('name')
                            <small style="color:red">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" value="{{$user->username}}"
                                    placeholder="Username" required>
                            </div>
                            @error('username')
                            <small style="color:red">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Level</label>
                                <select name="level" id="" class="form-control" @required(true)>
                                    <option value="">-- Pilih Level --</option>
                                    <option {{$user->level == 'admin' ? 'selected' : ''}} value="admin">admin</option>
                                    <option {{$user->level == 'owner' ? 'selected' : ''}} value="owner">owner</option>
                                </select>
                            </div>
                            @error('level')
                            <small style="color:red">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <img src="/user_images/{{$user->foto}}" alt="" class="img-fluid">
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" class="form-control" name="foto" placeholder="Foto">
                            </div>
                            @error('foto')
                            <small style="color:red">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Password (Isi untuk mengubah)</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            @error('password')
                            <small style="color:red">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Password Baru">
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
