@extends('layouts.admin')
@section('title', 'Tambah User')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('petugas.users.index') }}">Users</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="row justify-content-center"><div class="col-lg-7">
<div class="card card-primary card-outline shadow-sm">
<div class="card-header"><h3 class="card-title"><i class="fas fa-user-plus mr-2"></i>Form User Baru</h3></div>
<div class="card-body">
<form action="{{ route('petugas.users.store') }}" method="POST">@csrf
<div class="form-group"><label>Nama Lengkap <span class="text-danger">*</span></label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="form-group"><label>Email <span class="text-danger">*</span></label>
<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="form-group"><label>Role <span class="text-danger">*</span></label>
<select name="role" class="form-control @error('role') is-invalid @enderror" required>
<option value="">-- Pilih Role --</option>
<option value="admin" {{ old('role')==='admin'?'selected':'' }}>Admin</option>
<option value="petugas" {{ old('role')==='petugas'?'selected':'' }}>Petugas</option>
<option value="pimpinan" {{ old('role')==='pimpinan'?'selected':'' }}>Pimpinan</option>
<option value="koperasi" {{ old('role')==='koperasi'?'selected':'' }}>Koperasi</option>
</select>
@error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="form-group"><label>No. Telepon</label>
<input type="text" name="phone" class="form-control" value="{{ old('phone') }}"></div>
<div class="form-group"><label>Password <span class="text-danger">*</span></label>
<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="form-group"><label>Konfirmasi Password <span class="text-danger">*</span></label>
<input type="password" name="password_confirmation" class="form-control" required></div>
<div class="row mt-3">
<div class="col-6"><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan</button></div>
<div class="col-6"><a href="{{ route('petugas.users.index') }}" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left mr-2"></i>Kembali</a></div>
</div>
</form>
</div>
</div>
</div></div>
@endsection

