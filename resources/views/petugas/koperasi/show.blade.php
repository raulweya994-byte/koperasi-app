@extends('layouts.app')
@section('title','Detail Koperasi')
@section('page-title','Detail Koperasi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('petugas.koperasi.index') }}">Koperasi</a></li>
<li class="breadcrumb-item active">{{ $koperasi->nama_usaha }}</li>
@endsection
@section('content')
<div class="row">
<div class="col-lg-4">
<div class="card card-primary card-outline shadow-sm">
<div class="card-body text-center pt-4">
<i class="fas fa-store fa-4x text-primary mb-3"></i>
<h4 class="font-weight-bold">{{ $koperasi->nama_usaha }}</h4>
<p class="text-muted">{{ $koperasi->no_registrasi }}</p>
{!! $koperasi->status_verifikasi_label !!}
</div>
<div class="card-footer p-0">
<ul class="list-group list-group-flush">
<li class="list-group-item d-flex justify-content-between"><span class="text-muted">Pemilik</span><span>{{ $koperasi->nama_pemilik }}</span></li>
<li class="list-group-item d-flex justify-content-between"><span class="text-muted">Distrik</span><span>{{ $koperasi->distrik }}</span></li>
<li class="list-group-item d-flex justify-content-between"><span class="text-muted">Kategori</span><span>{{ ucfirst($koperasi->kategori) }}</span></li>
<li class="list-group-item d-flex justify-content-between"><span class="text-muted">Telepon</span><span>{{ $koperasi->no_telp ?? '-' }}</span></li>
</ul>
</div>
</div>
</div>
<div class="col-lg-8">
@if($koperasi->status_verifikasi === 'pending')
<div class="card card-warning card-outline shadow-sm mb-3">
<div class="card-header"><h6 class="mb-0 font-weight-bold"><i class="fas fa-check-circle mr-2"></i>Verifikasi Koperasi</h6></div>
<div class="card-body">
<form method="POST" action="{{ route('petugas.koperasi.verifikasi',$koperasi) }}">@csrf
<div class="form-group"><label>Status</label>
<select name="status_verifikasi" class="form-control" required>
<option value="diverifikasi">✓ Setujui & Verifikasi</option>
<option value="ditolak">✗ Tolak</option>
</select></div>
<div class="form-group"><label>Catatan</label><textarea name="catatan_verifikasi" class="form-control" rows="3"></textarea></div>
<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-save mr-2"></i>Simpan Verifikasi</button>
</form>
</div>
</div>
@endif
<div class="card shadow-sm mb-3">
<div class="card-header bg-light"><h6 class="mb-0 font-weight-bold">Informasi Usaha</h6></div>
<div class="card-body">
<table class="table table-borderless table-sm mb-0">
<tr><td class="text-muted">Jenis Usaha</td><td>{{ $koperasi->jenis_usaha }}</td></tr>
<tr><td class="text-muted">Alamat</td><td>{{ $koperasi->alamat }}</td></tr>
<tr><td class="text-muted">Kelurahan</td><td>{{ $koperasi->kelurahan }}</td></tr>
<tr><td class="text-muted">Modal</td><td>Rp {{ number_format($koperasi->modal_usaha,0,',','.') }}</td></tr>
<tr><td class="text-muted">Omset/Bln</td><td>Rp {{ number_format($koperasi->omset_per_bulan,0,',','.') }}</td></tr>
<tr><td class="text-muted">Karyawan</td><td>{{ $koperasi->jumlah_karyawan }} orang</td></tr>
</table>
</div>
</div>
<a href="{{ route('petugas.koperasi.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
</div>
</div>
@endsection
