@extends('public.layouts.app')
@section('title','Daftar Pelatihan')
@section('content')
<section style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0 40px;color:white;">
    <div class="container text-center">
        <h2 class="font-weight-bold mb-2">Daftar Pelatihan</h2>
        <p style="opacity:.75">{{ $pelatihan->judul }}</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @if(session('success'))
                <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
                @endif
                <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;">
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold text-primary mb-3">{{ $pelatihan->judul }}</h5>
                        <div style="font-size:13px;">
                            <div class="mb-2"><i class="fas fa-calendar-alt mr-2 text-primary"></i>{{ $pelatihan->tanggal_mulai->format('d M Y') }}@if($pelatihan->tanggal_selesai) — {{ $pelatihan->tanggal_selesai->format('d M Y') }}@endif</div>
                            <div class="mb-2"><i class="fas fa-map-marker-alt mr-2 text-danger"></i>{{ $pelatihan->lokasi }}</div>
                            <div class="mb-2"><i class="fas fa-users mr-2 text-success"></i>Kuota: {{ $pelatihan->kuota }} peserta</div>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-sm" style="border-radius:12px;">
                    <div class="card-header" style="background:#1a3a6e;color:white;border-radius:12px 12px 0 0;">
                        <h5 class="mb-0"><i class="fas fa-user-plus mr-2"></i>Form Pendaftaran</h5>
                    </div>
                    <form method="POST" action="{{ route('pelatihan.daftar.store', $pelatihan) }}">
                        @csrf
                        <div class="card-body p-4">
                            <div class="form-group">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_peserta" class="form-control @error('nama_peserta') is-invalid @enderror" value="{{ old('nama_peserta') }}" required>
                                @error('nama_peserta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>No HP <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Nama Usaha</label>
                                <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha') }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane mr-1"></i>Kirim Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection