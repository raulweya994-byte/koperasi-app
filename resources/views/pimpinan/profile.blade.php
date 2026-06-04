@extends('layouts.app')
@section('title','Profil')
@section('page-title','Profil Saya')
@section('breadcrumb')<li class="breadcrumb-item active">Profil</li>@endsection
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="card card-primary card-outline shadow-sm">
<div class="card-header"><h3 class="card-title">Edit Profil</h3></div>
<div class="card-body">
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<form action="{{ route('pimpinan.profile.update') }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
<div class="form-group">
<label class="font-weight-bold">Foto Profil</label>
<div class="d-flex align-items-center mb-2">
@if(auth()->user()->profile_photo)
<img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" id="previewFoto" class="rounded-circle mr-3" style="width:80px;height:80px;object-fit:cover;border:3px solid #1a3a6e;">
@else
<div id="avatarInisial" class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width:80px;height:80px;background:#1a3a6e;font-size:28px;color:white;font-weight:bold;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
<img src="" id="previewFoto" class="rounded-circle mr-3" style="width:80px;height:80px;object-fit:cover;display:none;border:3px solid #1a3a6e;">
@endif
<div>
<input type="file" id="inputFoto" name="profile_photo" accept="image/*" class="form-control-file" onchange="previewGambar(this)">
<small class="text-muted">JPG/PNG maks 2MB. Kosongkan jika tidak diubah.</small>
</div>
</div>
</div>
<div class="form-group"><label>Nama</label><input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required></div>
<div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required></div>
<div class="form-group"><label>Password Baru</label><input type="password" name="password" class="form-control"></div>
<div class="form-group"><label>Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control"></div>
<button type="submit" class="btn btn-primary btn-block">Simpan</button>
</form></div></div></div></div>
@endsection
